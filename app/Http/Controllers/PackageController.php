<?php

namespace App\Http\Controllers;

use App\Models\SafariPackage;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $pageIntro = PageContent::where('page_slug', 'packages.php')
            ->where('section_key', 'main')
            ->first();

        return view('packages', compact('packages', 'pageIntro'));
    }
}
