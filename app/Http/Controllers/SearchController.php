<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $animeResults = Anime::where('title', 'like', "%$query%")->get();
        $staffResults = Staff::where('name', 'like', "%$query%")->get();
        $userResults = User::where('name', 'like', "%$query%")->get();

        return view('search.index', compact('animeResults', 'staffResults', 'userResults', 'query'));
    }
}
