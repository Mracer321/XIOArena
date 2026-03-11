<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;


class PublicOrgController extends Controller
{
    // All Orgs
    public function index(Request $request)
    {
        $query = \App\Models\Organization::query()
            ->where('trust_status', '!=', 'banned');

        // 🔎 Search by name
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🎯 Filter by trust status
        if ($request->filter) {
            $query->where('trust_status', $request->filter);
        }

        $orgs = $query
            ->orderByRaw("
            CASE 
                WHEN membership = 'premium' THEN 1
                WHEN membership = 'verified' THEN 2
                ELSE 3
            END
        ")
            ->orderByRaw("
            CASE 
                WHEN trust_status = 'trusted' THEN 1
                ELSE 2
            END
        ")
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('organizations.index', compact('orgs'));
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
