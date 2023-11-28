<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Character;
use App\Models\Anime_Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function create()
    {
        return view('character.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $character = Character::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'profile_picture' => $request->file('profile_picture')->store('profile_pictures', 'public'),
        ]);

        return redirect()->route('characters.create')->with('success', 'Character created successfully!');
    }

    public function show(Character $character)
    {
        return view('character.show', compact('character'));
    }

    public function createConnection(Anime $anime)
    {
        $anime->load('Anime_Character.character');

        $characters = Character::all();

        return view('character.create-connection', compact('anime', 'characters'));
    }

    public function storeconnection(Request $request, Anime $anime)
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

    public function showAll(Anime $anime)
    {
        $anime->load('Anime_Character.character');

        return view('character.show-all', compact('anime'));
    }
}
