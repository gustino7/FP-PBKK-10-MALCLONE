<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

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
}
