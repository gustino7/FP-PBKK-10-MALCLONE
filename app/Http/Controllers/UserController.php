<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        $isAuthenticated = Auth::check();

        return view('profile.user', compact('user', 'isAuthenticated'));
    }

    public function animeList($username, $status)
    {
        $user = User::where('name', $username)->first();

        if (!$user) {
            abort(404); 
        }

        $reviews = $user->Review()->where('status', $status)->get();

        return view('user.animeList', [
            'user' => $user,
            'status' => $status,
            'reviews' => $reviews,
        ]);
    }

    public function animeListStatus($userId, $status)
    {
        $user = User::findOrFail($userId);

        return view('user.animeList', ['user' => $user, 'status' => $status]);
    }
}
