<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AnimeController extends Controller
{
    public function index()
    {
        // Replace this with the actual logic to fetch the top-ranked anime records.
        $topAnimes = Anime::orderBy('avg_rating', 'desc')->get();

        return view('top-anime', compact('topAnimes'));
    }

    public function show($id)
    {
        $anime = Anime::findOrFail($id);
        $user = Auth::user();
        
        // Average rating for anime from review
        $avg_rating = Review::where('anime_id', $anime->id)->avg('rating');
        $anime->avg_rating = number_format($avg_rating,2);
        
        // Get the ranking by ordering animes by avg_rating
        $rank = Anime::orderByDesc('avg_rating')->pluck('id')->search($anime->id);

        // Edit status
        $review_id = Review::where('user_id', $user->id)->where('anime_id', $anime->id)->value('id');
        $review = Review::find($review_id);
        return view('anime.show', compact('anime', 'rank', 'review', 'review_id'));
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

        // Extract year and month from premiered date
        $premieredYear = date('Y', strtotime($request->premiered));
        $premieredMonth = date('m', strtotime($request->premiered));

        // Determine the season based on the month
        $season = '';
        if ($premieredMonth >= 1 && $premieredMonth <= 3) {
            $season = 'Winter';
        } elseif ($premieredMonth >= 4 && $premieredMonth <= 6) {
            $season = 'Spring';
        } elseif ($premieredMonth >= 7 && $premieredMonth <= 9) {
            $season = 'Summer';
        } elseif ($premieredMonth >= 10 && $premieredMonth <= 12) {
            $season = 'Fall';
        }

        // Concatenate the season and year
        $seasonYear = $season . ' ' . $premieredYear;

        // Create the anime record
        Anime::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'type' => $request->type,
            'episode' => $request->episode,
            'status' => $request->status,
            'premiered' => $request->premiered,
            'season' => $seasonYear, // Save the season and year
            'poster' => $imageName,
        ]);

        return redirect()->route('dashboard');
    }

    public function getAllDashboard(){
        return view('dashboard')->with([
            'animes_tv' => Anime::where('type', 'TV')->get(),
            'animes_latest' => Anime::orderBy('updated_at','desc')->get(),
            'animes_upcoming' => Anime::where('status', 'Not Yet Aired')->take(5)->get(),
            'animes_top' => Anime::orderBy('avg_rating', 'desc')->take(5)->get()
        ]);
    }

    public function create()
    {
        return view('anime.create');
    }

    public function seasonalAnime($year, $season)
    {
        // Define the array of seasons
        $seasonsArray = ['winter', 'spring', 'summer', 'fall'];
    
        // Determine the start and end months for the selected season
        $startMonth = $this->getStartMonth($season);
        $endMonth = $this->getEndMonth($season);
    
        // Fetch anime for the selected season and year
        $seasonalAnimes = Anime::whereYear('premiered', $year)
            ->whereMonth('premiered', '>=', $startMonth)
            ->whereMonth('premiered', '<=', $endMonth)
            ->get();
    
        // Calculate previous and next year and season
        $prevYear = $year - 1;
        $nextYear = $year + 1;
    
        $prevSeason = ($season == 'winter') ? 'fall' : $seasonsArray[array_search($season, $seasonsArray) - 1];
        $nextSeason = ($season == 'fall') ? 'winter' : $seasonsArray[array_search($season, $seasonsArray) + 1];
    
        // Generate the array of seasons
        $seasons = [];
        foreach ($seasonsArray as $seasonItem) {
            $seasons[] = [
                'year' => ($seasonItem == 'winter' && $season == 'winter') ? $prevYear : $year,
                'season' => $seasonItem,
                'label' => ucfirst($seasonItem) . ' ' . (($seasonItem == 'winter' && $season == 'winter') ? $prevYear : $year),
            ];
        }
    
        // Pass the data to the view
        return view('seasonal-anime', compact('seasonalAnimes', 'season', 'year', 'prevYear', 'nextYear', 'prevSeason', 'nextSeason', 'seasons'));
    }

    private function getStartMonth($season)
    {
        switch ($season) {
            case 'winter':
                return 1; // January
            case 'spring':
                return 4; // April
            case 'summer':
                return 7; // July
            case 'fall':
                return 10; // October
            default:
                return 1; // January by default
        }
    }

    private function getEndMonth($season)
    {
        switch ($season) {
            case 'winter':
                return 3; // March
            case 'spring':
                return 6; // June
            case 'summer':
                return 9; // September
            case 'fall':
                return 12; // December
            default:
                return 12; // December by default
        }
    }
}
