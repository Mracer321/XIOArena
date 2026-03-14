<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;


class PublicOrgController extends Controller
{
    // All Orgs
    public function index(Request $request)
    {
        $query = Organization::query()
            ->where('trust_status', '!=', 'banned');

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter
        if ($request->filter) {
            $query->where('trust_status', $request->filter);
        }

        $orgs = $query
            ->withCount('tournaments')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Tab counts
        $counts = [
            'all' => Organization::count(),
            'trusted' => Organization::where('trust_status', 'trusted')->count(),
            'verified' => Organization::where('trust_status', 'verified')->count(),
            'normal' => Organization::where('trust_status', 'normal')->count(),
        ];

        return view('organizations.index', compact('orgs', 'counts'));
    }

    // Single Org
    public function show($slug)
    {
        $org = Organization::with(['tournaments' => function ($q) {
            $q->where('is_visible', true)->latest();
        }])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('organizations.show', compact('org'));
    }
}
