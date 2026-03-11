<?php

namespace App\Http\Controllers;

use App\Models\Organization;

class OrgController extends Controller
{
    public function show($id)
    {
        $org = Organization::with('tournaments')->findOrFail($id);

        return view('organizations.show', compact('org'));
    }
}
