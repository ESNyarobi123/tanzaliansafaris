<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = Gallery::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gallery', compact('galleryItems'));
    }
}
