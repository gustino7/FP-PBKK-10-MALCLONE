<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class StudioController extends Controller
{
    public function create()
    {
        return view('studio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'established' => 'required|date',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed file types and size
        ]);

        // Handle file upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create a new studio instance
        $studio = Studio::create([
            'name' => $request->input('name'),
            'established' => $request->input('established'),
            'description' => $request->input('description'),
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('studio.create')->with('success', 'Studio created successfully.');
    }

    public function show(Studio $studio)
    {
        return view('studio.show', compact('studio'));
    }
}
