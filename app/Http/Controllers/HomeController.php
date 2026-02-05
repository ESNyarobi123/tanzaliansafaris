<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\Gallery;
use App\Models\SafariPackage;
use App\Models\TeamMember;
use App\Models\HeroImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch gallery items
        $galleryItems = Gallery::where('status', 'active')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        // Fetch page content for home and about
        $contents = PageContent::whereIn('page_slug', ['home', 'about'])->get();
        
        $homeContent = [];
        $aboutContent = [];
        
        foreach ($contents as $row) {
            if ($row->page_slug === 'home') {
                $homeContent[$row->section_key] = $row->content;
            } elseif ($row->page_slug === 'about') {
                $aboutContent[$row->section_key] = $row->content;
            }
        }

        // Backward compatibility logic
        $aboutPageContent = !empty($aboutContent) ? $aboutContent : $homeContent;
        $pageContent = $homeContent;

        // Parse pills
        $pillsRaw = $aboutPageContent['about_pills'] ?? 'Private Safaris, Group & Family Trips, Zanzibar Holidays, Car Hire & Transfers';
        $pills = $this->parseListItems($pillsRaw);

        // Fetch featured packages
        $featuredPackages = SafariPackage::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();

        // Fetch team members for homepage
        $teamMembers = TeamMember::active()
            ->ordered()
            ->take(4)
            ->get();

        // Fetch hero images for slider
        $heroImages = HeroImage::active()
            ->ordered()
            ->get();

        return view('home', compact('galleryItems', 'homeContent', 'aboutPageContent', 'pageContent', 'featuredPackages', 'pills', 'teamMembers', 'heroImages'));
    }

    public function about()
    {
        $contents = PageContent::where('page_slug', 'about')->get();
        $aboutContent = [];
        foreach ($contents as $row) {
            $aboutContent[$row->section_key] = $row->content;
        }

        $pillsRaw = $aboutContent['about_pills'] ?? 'Private Safaris, Group & Family Trips, Zanzibar Holidays, Car Hire & Transfers';
        $pills = $this->parseListItems($pillsRaw);

        return view('about', compact('aboutContent', 'pills'));
    }

    private function parseListItems($raw)
    {
        $raw = trim($raw);
        if ($raw === '') return [];
        $raw = str_replace(["\r\n", "\r"], "\n", $raw);
        $parts = preg_split('/[\n,\|]+/', $raw);
        $out = [];
        foreach ($parts as $p) {
            $p = trim($p);
            if ($p !== '') $out[] = $p;
        }
        return $out;
    }
}
