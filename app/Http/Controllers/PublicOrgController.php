<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


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
        if ($request->filter === 'trusted') {
            $query->where('trust_status', 'trusted');
        }

        if ($request->filter === 'verified') {
            $query->where('membership', 'verified');
        }

        if ($request->filter === 'normal') {
            $query->where('membership', 'free');
        }

        $orgs = $query
            ->withCount('tournaments')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Tab counts
        $counts = [

            'all' => Organization::where('trust_status', '!=', 'banned')->count(),

            'trusted' => Organization::where('trust_status', 'trusted')->count(),

            'verified' => Organization::where('membership', 'verified')->count(),

            'normal' => Organization::where('membership', 'free')->count(),

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



    public function socialStats($slug)
    {
        $org = Organization::where('slug', $slug)->firstOrFail();

        $youtube = null;
        $instagram = null;
        $discord = null;

        /*
    --------------------------
    YOUTUBE SUBSCRIBERS
    --------------------------
    */

        if ($org->youtube) {

            preg_match('/@([a-zA-Z0-9_\-]+)/', $org->youtube, $matches);
            $handle = $matches[1] ?? null;

            if ($handle) {

                $youtube = Cache::remember("yt_" . $handle, 3600, function () use ($handle) {

                    $apiKey = env('YOUTUBE_API_KEY');

                    $response = Http::get(
                        "https://www.googleapis.com/youtube/v3/channels",
                        [
                            "part" => "statistics",
                            "forHandle" => $handle,
                            "key" => $apiKey
                        ]
                    );

                    if (!$response->successful()) return null;

                    return $response["items"][0]["statistics"]["subscriberCount"] ?? null;
                });
            }
        }

        /*
    --------------------------
    INSTAGRAM FOLLOWERS
    --------------------------
    */

        if ($org->instagram) {

            preg_match('/instagram\.com\/([^\/]+)/', $org->instagram, $matches);
            $username = $matches[1] ?? null;

            if ($username) {

                $instagram = Cache::remember("ig_" . $username, 3600, function () use ($username) {

                    $token = env("APIFY_TOKEN");

                    $response = Http::post(
                        "https://api.apify.com/v2/acts/apify~instagram-profile-scraper/run-sync-get-dataset-items?token=" . $token,
                        [
                            "usernames" => [$username]
                        ]
                    );

                    if (!$response->successful()) return null;

                    $data = $response->json();

                    return $data[0]["followersCount"] ?? null;
                });
            }
        }

        /*
    --------------------------
    DISCORD MEMBERS
    --------------------------
    */

        $discord = null;

        if ($org->discord) {

            preg_match('/(?:discord\.gg|discord\.com\/invite)\/([A-Za-z0-9]+)/', $org->discord, $matches);
            $invite = $matches[1] ?? null;

            if ($invite) {

                $response = Http::get(
                    "https://discord.com/api/v9/invites/" . $invite . "?with_counts=true"
                );



                if ($response->successful()) {

                    $data = $response->json();

                    $discord = $data['approximate_member_count'] ?? null;
                } else {
                    $discord = null;
                }
            }
        }

        $discord = Cache::remember("discord_" . $invite, 3600, function () use ($invite) {

            $response = Http::get(
                "https://discord.com/api/v9/invites/" . $invite . "?with_counts=true"
            );

            if (!$response->successful()) return null;

            return $response->json()['approximate_member_count'] ?? null;
        });

        return response()->json([
            "youtube" => $youtube,
            "instagram" => $instagram,
            "discord" => $discord
        ]);
    }
}
