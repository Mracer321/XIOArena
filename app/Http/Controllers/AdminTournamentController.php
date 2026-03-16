<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Organization;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminTournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::with('organization')->latest()->get();
        return view('admin.tournaments.index', compact('tournaments'));

        // $tournaments = \App\Models\Tournament::with('organization')
        //     ->latest()
        //     ->get();

        // return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        $orgs = Organization::where('trust_status', '!=', 'banned')->get();
        return view('admin.tournaments.create', compact('orgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required',
            'title' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $org = Organization::findOrFail($request->organization_id);

        // Membership limit check
        if ($org->membership !== 'premium') {

            if ($org->tournaments()->count() >= $org->tournament_limit) {
                return back()->with('error', 'Tournament limit reached.');
            }
        }

        // Poster upload
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')
                ->store('tournaments/posters', 'public');
        }

        // Additional images upload
        $additionalImages = [];

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('tournaments/gallery', 'public');
                $additionalImages[] = $path;
            }
        }

        $slug = Str::slug($request->title) . '-' . uniqid();

        Tournament::create([
            'organization_id' => $org->id,
            'title' => $request->title,
            'slug' => $slug,
            'poster' => $posterPath,
            'prize_pool' => $request->prize_pool ?? 0,
            'total_slots' => $request->total_slots ?? 0,
            'entry_type' => $request->entry_type,
            'registration_status' => $request->registration_status,
            'about' => $request->about,
            'additional_images' => $additionalImages,
        ]);

        return redirect('/admin/tournaments')
            ->with('success', 'Tournament created successfully.');
    }
    public function edit($id)
    {
        $tournament = \App\Models\Tournament::findOrFail($id);
        return view('admin.tournaments.edit', compact('tournament'));
    }

    public function update(Request $request, $id)
    {
        $tournament = \App\Models\Tournament::findOrFail($id);

        $tournament->type = $request->type;
        $tournament->is_featured = $request->has('is_featured');
        $tournament->is_visible = $request->has('is_visible');
        $tournament->is_scammed = $request->has('is_scammed');
        $tournament->pp_pending = $request->has('pp_pending');
        $tournament->priority = $request->priority ?? 0;


        if ($request->featured_until) {
            $tournament->featured_until = $request->featured_until;
        }

        $tournament->save();

        return redirect('/admin/tournaments')
            ->with('success', 'Tournament updated successfully.');
    }
}
