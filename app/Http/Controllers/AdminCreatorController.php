<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCreatorController extends Controller
{
    public function index(Request $request)
    {
        $query = Creator::with('games')->latest();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $creators = $query->paginate(12);

        return view('admin.creators.index', compact('creators'));
    }

    public function create()
    {
        return view('admin.creators.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'discord' => 'nullable|url',
        ]);

        $data = $request->only([
            'name',
            'bio',
            'youtube',
            'instagram',
            'discord',
            'contact_email',
            'contact_phone'
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('creators', 'public');
        }

        $creator = Creator::create($data);

        foreach ($request->games ?? [] as $game) {
            if ($game) {
                $creator->games()->create(['game_name' => $game]);
            }
        }

        return redirect('/admin/creators')->with('success', 'Creator added');
    }

    public function edit($id)
    {
        $creator = Creator::with('games')->findOrFail($id);
        return view('admin.creators.edit', compact('creator'));
    }

    public function update(Request $request, $id)
    {
        $creator = Creator::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'discord' => 'nullable|url',
        ]);

        $data = $request->only([
            'name',
            'bio',
            'youtube',
            'instagram',
            'discord',
            'contact_email',
            'contact_phone'
        ]);

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('profile_image')) {
            if ($creator->profile_image && Storage::disk('public')->exists($creator->profile_image)) {
                Storage::disk('public')->delete($creator->profile_image);
            }

            $data['profile_image'] = $request->file('profile_image')->store('creators', 'public');
        }

        $creator->update($data);

        $creator->games()->delete();

        foreach ($request->games ?? [] as $game) {
            if ($game) {
                $creator->games()->create(['game_name' => $game]);
            }
        }

        return redirect('/admin/creators')->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $creator = Creator::findOrFail($id);

        if ($creator->profile_image && Storage::disk('public')->exists($creator->profile_image)) {
            Storage::disk('public')->delete($creator->profile_image);
        }

        $creator->delete();

        return back()->with('success', 'Deleted');
    }

    public function show($id)
    {
        $creator = Creator::with('games')->findOrFail($id);
        return view('admin.creators.show', compact('creator'));
    }
}
