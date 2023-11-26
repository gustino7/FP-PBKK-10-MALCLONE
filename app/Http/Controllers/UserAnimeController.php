<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAnimeController extends Controller
{
    public function addToList($id){
        $anime_id = $id;
        $user = Auth::user();
        // Log::info($anime_id, $user_id);

        User_Anime::create([
            'user_id' => $user->id,
            'anime_id' => $anime_id
        ]);

        return redirect()->route('anime.show', ['id' => $anime_id]);
    }

    public function removeToList($id){
        $anime_id = $id;
        $user = Auth::user();
        $user_anime = User_Anime::where('user_id', $user->id)->where('anime_id', $anime_id)->first();

        // Condition where user have review after addlist and want to drop list
        if($user_anime){
            Review::where('user_id', $user->id)->where('anime_id', $anime_id)->delete();
            User_Anime::where('user_id', $user->id)->where('anime_id', $anime_id)->delete();
        }
        return redirect()->route('anime.show', ['id' => $anime_id]);
    }
}
