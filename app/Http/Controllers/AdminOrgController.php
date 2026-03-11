<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Organization;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdminOrgController extends Controller
{
    public function index()
    {
        $orgs = Organization::all();
        return view('admin.orgs.index', compact('orgs'));
    }

    public function create()
    {
        return view('admin.orgs.create');
    }

    public function store(Request $request)
    {

        Log::info($request->all());

        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image',
        ]);

        $slug = Str::slug($request->name) . '-' . uniqid();

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('orgs', 'public');
        }

        Organization::create([
            'name' => $request->name,
            'slug' => $slug,
            'logo' => $logoPath,
            'instagram' => $request->instagram,
            'discord' => $request->discord,
            'youtube' => $request->youtube,
            'website' => $request->website,
            'description' => $request->description,
            'membership' => $request->membership,
            'trust_status' => $request->trust_status,
            'tournament_limit' => 2,

        ]);

        return redirect('/admin/orgs')->with('success', 'Organization created.');
    }

    public function updateTrust(Request $request, $id)
    {
        $org = Organization::findOrFail($id);

        $request->validate([
            'trust_status' => 'required|in:trusted,new'

        ]);

        $org->trust_status = $request->trust_status;
        $org->save();

        return back()->with('success', 'Trust status updated successfully.');
    }

    public function updateMembership(Request $request, $id)
    {
        $org = Organization::findOrFail($id);

        $request->validate([
            'membership' => 'required|in:verified,free'
        ]);

        $org->membership = $request->membership;

        // Optional: increase tournament limit if verified
        if ($request->membership == 'verified') {
            $org->tournament_limit = 10;
        }

        $org->save();

        return back()->with('success', 'Membership updated successfully.');
    }

    public function ban($id)
    {
        $org = Organization::findOrFail($id);

        $org->trust_status = 'banned';
        $org->save();

        return back()->with('success', 'Organization banned successfully.');
    }
}
