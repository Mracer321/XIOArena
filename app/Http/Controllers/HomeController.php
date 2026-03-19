<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Organization;
use App\Models\Creator;

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

        $orgs = Organization::where('trust_status', 'trusted')
            ->orderByRaw("
                CASE 
                    WHEN membership = 'premium' THEN 1
                    WHEN membership = 'verified' THEN 2
                    ELSE 3
                END
            ")
            ->take(4)
            ->get();

        $featuredCreators = Creator::with('games')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('featured', 'latest', 'orgs', 'featuredCreators'));
    }
}
