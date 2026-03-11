<?php

namespace App\Http\Controllers;

use App\Models\Tournament;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Tournament::where('is_visible', true)
            ->where('is_featured', true)
            ->orderByDesc('priority')
            ->take(4)
            ->get();

        $latest = Tournament::where('is_visible', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('featured', 'latest'));
    }
}
