<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Organization;


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

        // Top orgs for homepage
        $orgs = Organization::where('trust_status', '!=', 'banned')
            ->orderByRaw("
            CASE 
                WHEN membership = 'premium' THEN 1
                WHEN membership = 'verified' THEN 2
                ELSE 3
            END
        ")
            ->take(4)
            ->get();

        return view('home', compact('featured', 'latest', 'orgs'));
    }
}
