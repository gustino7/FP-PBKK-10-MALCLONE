<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Character;
use App\Models\Anime_Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function create(Anime $anime)
    {
        $anime->load('Anime_Character.character');

        $characters = Character::all();

        return view('character.create', compact('anime', 'characters'));
    }

    public function store(Request $request, Anime $anime)
    {
        $request->validate([
            'character_id' => 'required|exists:characters,id',
            'role' => 'required|in:Main,Supporting',
        ]);

        if (!$anime->Anime_Character->contains('character_id', $request->character_id)) {
            $anime->Anime_Character()->create([
                'character_id' => $request->character_id,
                'role' => $request->role,
            ]);

            return redirect()->route('anime.show', ['id' => $anime->id])
                ->with('success', 'Character added to anime successfully.');
        }

        return redirect()->route('anime.show', ['id' => $anime->id])
            ->with('error', 'Character is already associated with the anime.');
    }
}
