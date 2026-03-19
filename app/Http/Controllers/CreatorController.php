<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CreatorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $game = $request->game;

        $query = Creator::with('games')
            ->where('is_active', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('games', function ($gameQuery) use ($search) {
                        $gameQuery->where('game_name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($game && $game !== 'all') {
            if ($game === 'others') {
                $query->whereHas('games', function ($q) {
                    $q->whereNotIn('game_name', ['BGMI', 'Free Fire', 'Valorant', 'Call of Duty']);
                });
            } else {
                $query->whereHas('games', function ($q) use ($game) {
                    $q->where('game_name', $game);
                });
            }
        }

        $creators = $query
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $featuredCreators = Creator::with('games')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(3)
            ->get();

        $gameCounts = [
            'all' => Creator::where('is_active', true)->count(),

            'BGMI' => Creator::where('is_active', true)
                ->whereHas('games', fn($q) => $q->where('game_name', 'BGMI'))
                ->count(),

            'Free Fire' => Creator::where('is_active', true)
                ->whereHas('games', fn($q) => $q->where('game_name', 'Free Fire'))
                ->count(),

            'Valorant' => Creator::where('is_active', true)
                ->whereHas('games', fn($q) => $q->where('game_name', 'Valorant'))
                ->count(),

            'Call of Duty' => Creator::where('is_active', true)
                ->whereHas('games', fn($q) => $q->where('game_name', 'Call of Duty'))
                ->count(),

            'others' => Creator::where('is_active', true)
                ->whereHas('games', function ($q) {
                    $q->whereNotIn('game_name', ['BGMI', 'Free Fire', 'Valorant', 'Call of Duty']);
                })
                ->count(),
        ];

        return view('creators.index', compact(
            'creators',
            'featuredCreators',
            'gameCounts',
            'search',
            'game'
        ));
    }

    public function show($slug)
    {
        $creator = Creator::with('games')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('creators.show', compact('creator'));
    }

    public function socialStats($slug)
    {
        $creator = Creator::where('slug', $slug)->firstOrFail();

        $youtube = null;
        $instagram = null;
        $discord = null;

        if ($creator->youtube) {
            preg_match('/@([a-zA-Z0-9_\-]+)/', $creator->youtube, $matches);
            $handle = $matches[1] ?? null;

            if ($handle) {
                $youtube = Cache::remember("creator_yt_" . $handle, 3600, function () use ($handle) {
                    $apiKey = env('YOUTUBE_API_KEY');

                    $response = Http::get('https://www.googleapis.com/youtube/v3/channels', [
                        'part' => 'statistics',
                        'forHandle' => $handle,
                        'key' => $apiKey,
                    ]);

                    if (!$response->successful()) {
                        return null;
                    }

                    return $response['items'][0]['statistics']['subscriberCount'] ?? null;
                });
            }
        }

        if ($creator->instagram) {
            preg_match('/instagram\.com\/([^\/\?]+)/', $creator->instagram, $matches);
            $username = $matches[1] ?? null;

            if ($username) {
                $instagram = Cache::remember("creator_ig_" . $username, 3600, function () use ($username) {
                    $token = env("APIFY_TOKEN");

                    $response = Http::post(
                        "https://api.apify.com/v2/acts/apify~instagram-profile-scraper/run-sync-get-dataset-items?token=" . $token,
                        [
                            "usernames" => [$username]
                        ]
                    );

                    if (!$response->successful()) {
                        return null;
                    }

                    $data = $response->json();

                    return $data[0]["followersCount"] ?? null;
                });
            }
        }

        if ($creator->discord) {
            preg_match('/(?:discord\.gg|discord\.com\/invite)\/([A-Za-z0-9]+)/', $creator->discord, $matches);
            $invite = $matches[1] ?? null;

            if ($invite) {
                $discord = Cache::remember("creator_discord_" . $invite, 3600, function () use ($invite) {
                    $response = Http::get(
                        "https://discord.com/api/v9/invites/" . $invite . "?with_counts=true"
                    );

                    if (!$response->successful()) {
                        return null;
                    }

                    return $response->json()['approximate_member_count'] ?? null;
                });
            }
        }

        return response()->json([
            'youtube' => $youtube,
            'instagram' => $instagram,
            'discord' => $discord,
        ]);
    }
}
