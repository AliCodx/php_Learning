<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('store.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $request->user()->contactMessages()->create($validated);

        return redirect()->route('contact.create')->with('success', 'Your message has been sent to the store team.');
    }

    public function index()
    {
        return view('admin.messages.index', [
            'messages' => ContactMessage::with('user')->latest()->paginate(12),
        ]);
    }
}
