<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class PublicTournamentController extends Controller
{
    // 🔥 OPEN TOURNAMENTS
    public function index(Request $request)
    {
        $query = Tournament::with('organization')
            ->where('is_visible', true)
            ->where('registration_status', 'open');

        // 🔎 Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 🎮 Type Filter
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // 💰 Entry Filter
        if ($request->entry_type) {
            $query->where('entry_type', $request->entry_type);
        }

        $tournaments = $query
            ->orderByDesc('is_featured')
            ->orderByDesc('priority')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('tournaments.index', compact('tournaments'));
    }


    // 🔥 CLOSED / PREVIOUS TOURNAMENTS
    public function closed(Request $request)
    {
        $query = Tournament::with('organization')
            ->where('is_visible', true)
            ->where('registration_status', 'closed');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tournaments = $query->latest()
            ->paginate(12)
            ->withQueryString();

        return view('tournaments.closed', compact('tournaments'));
    }


    public function show($slug)
    {
        $tournament = Tournament::with('organization')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('tournaments.show', compact('tournament'));
    }
}
