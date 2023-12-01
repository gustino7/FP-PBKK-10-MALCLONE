<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User_Anime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnimeController extends Controller
{
    public function index()
    {
        $topAnimes = Anime::orderBy('avg_rating', 'desc')->get();
        $user = Auth::user();

        return view('top-anime', compact('topAnimes', 'user'));
    }


    public function show($id)
    {
        $anime = Anime::findOrFail($id);
        $user = Auth::user();

        // Average rating for anime from review
        $anime->avg_rating = number_format($anime->avg_rating, 2);

        // Get the ranking by ordering animes by avg_rating
        $rank = Anime::orderByDesc('avg_rating')->pluck('id')->search($anime->id);

        // Edit status
        $review_id = Review::where('user_id', $user->id)->where('anime_id', $anime->id)->value('id');
        $review = Review::find($review_id);

        // To get info user_anime (add to list)
        $user_anime = User_Anime::where('user_id', $user->id)->where('anime_id', $anime->id)->value('created_at');

        // Get reviews in this anime
        $latest_reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('animes', 'reviews.anime_id', '=', 'animes.id')
            ->select('reviews.id as review_id', 'reviews.comment', 'reviews.created_at', 'users.profile_picture', 'animes.title', 'users.name', 'animes.id')
            ->where('animes.id', $anime->id)
            ->orderBy('created_at', 'desc')
            ->take(5)->get();

        return view('anime.show', compact('anime', 'rank', 'review', 'review_id', 'user_anime', 'latest_reviews'));
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

    public function getAllDashboard()
    {
        Carbon::setLocale('en');
        $latest_reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('animes', 'reviews.anime_id', '=', 'animes.id')
            ->select('reviews.id as reviewId', 'reviews.comment', 'reviews.created_at', 'animes.poster', 'animes.title', 'users.name', 'animes.id')
            ->orderBy('created_at', 'desc')
            ->take(5)->get();

        // Time Differences
        $current_time = Carbon::now();
        foreach ($latest_reviews as $review) {
            $created_at_time = Carbon::parse($review->created_at);
            $review->created_at = $current_time->diffForHumans($created_at_time, true);
        }
        return view('dashboard')->with([
            'animes_tv' => Anime::where('type', 'TV')->get(),
            'animes_latest' => Anime::orderBy('updated_at', 'desc')->get(),
            'animes_upcoming' => Anime::where('status', 'Not Yet Aired')->take(5)->get(),
            'animes_top' => Anime::orderBy('avg_rating', 'desc')->take(5)->get(),
            'reviews' => $latest_reviews
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

        $currentYear = Carbon::now()->year;

        // Check if the requested year is the current year
        if ($year == $currentYear) {
            $cacheKey = 'seasonal_anime_' . $currentYear;

            // Check if data is in cache
            if (Cache::has($cacheKey)) {
                Log::info('Data found in cache for key: ' . $cacheKey);
                $seasonalAnimes = Cache::get($cacheKey);
            } else {
                Log::info('Cache miss for key: ' . $cacheKey);

                // Determine the start and end months for the selected season
                $startMonth = $this->getStartMonth($season);
                $endMonth = $this->getEndMonth($season);

                // Fetch anime for the selected season and year
                $seasonalAnimes = Anime::whereYear('premiered', $currentYear)
                    ->whereMonth('premiered', '>=', $startMonth)
                    ->whereMonth('premiered', '<=', $endMonth)
                    ->get();

                // Cache the data
                Cache::put($cacheKey, $seasonalAnimes, now()->addHours(24));
            }
        } else {
            // Handle the case for years other than the current year without caching
            $seasonalAnimes = Anime::whereYear('premiered', $year)
                ->whereMonth('premiered', '>=', $startMonth)
                ->whereMonth('premiered', '<=', $endMonth)
                ->get();
        }

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

    public function addCharacter(Request $request, Anime $anime)
    {
        $anime->characters()->createMany($request->input('characters'));

        return redirect()->route('anime.show', ['id' => $anime->id])->with('success', 'Characters added successfully');
    }

    public function storeStaffConnection(Request $request, Anime $anime)
    {
        $anime->Anime_Staff()->createMany($request->input('staff'));

        return redirect()->route('anime.show', ['id' => $anime->id])
            ->with('success', 'Staff members added successfully.');
    }
}
