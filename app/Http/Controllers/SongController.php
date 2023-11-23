<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class SongController extends Controller
{
    //
    public function create(Anime $anime)
    {
        return view('song.create', compact('anime'));
    }

    public function store(Request $request, Anime $anime)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'theme_type' => 'required|in:Opening,Ending',
            'singer' => 'required|string|max:255',
        ]);

        $anime->Song()->create([
            'title' => $request->title,
            'theme_type' => $request->theme_type,
            'singer' => $request->singer,
        ]);

        return redirect()->route('anime.show', ['id' => $anime->id])
            ->with('success', 'Song added successfully.');
    }
}
