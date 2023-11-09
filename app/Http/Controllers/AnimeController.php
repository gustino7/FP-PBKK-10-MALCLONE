<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Str;

class AnimeController extends Controller
{
    public function index()
    {
        // Replace this with the actual logic to fetch the top-ranked anime records.
        $topAnimes = Anime::orderBy('rating', 'desc')->get();

        return view('top-anime', compact('topAnimes'));
    }

    public function show($id)
    {
        $anime = Anime::find($id);
        return view('anime.show', ['anime' => $anime]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'type' => 'required|in:TV,Movie,OVA',
            'episode' => 'required|integer|min:1',
            'status' => 'required|in:Airing,Finished,Not Yet Aired',
            'premiered' => 'required|date',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Handle image upload
        $imageName = Str::random(20) . '.' . $request->file('poster')->getClientOriginalExtension();
        $request->file('poster')->storeAs('posters', $imageName, 'public');

        // Create the anime record
        Anime::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'type' => $request->type,
            'episode' => $request->episode,
            'status' => $request->status,
            'premiered' => $request->premiered,
            'poster' => $imageName, // Store the image filename in the database
        ]);

        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('anime.create');
    }
}
