<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ($request->website != null) {
            return back();
        }

        SupportTicket::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}
