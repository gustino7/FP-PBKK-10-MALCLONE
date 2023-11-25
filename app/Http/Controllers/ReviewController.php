<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Review;
use App\Models\User;
use App\Models\User_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function show($anime_id, $user_id){
        $anime = Anime::findorfail($anime_id);
        $review = Review::where('user_id', $user_id)->where('anime_id', $anime->id)->value('id');
        
        // To get info user_anime (add to list)
        $user_anime = User_Anime::where('user_id', $user_id)->where('anime_id', $anime->id)->value('created_at');
        // Log::info("anime-id", $anime->toArray());
        // Log::info("review-id", $review->toArray());

        if($user_anime){
            if($review){
                return view('review.already-review');
            }else{
                return view('review.create', compact('anime'));
            }
        }else{
            return redirect()->route('anime.show', ['id' => $anime_id])->with('message', 'This anime is not on your list and therefore you cannot review it.');
        }
    }

    public function create(Request $request){
        $anime_id = $request->input('anime_id');
        $user_id = $request->input('user_id');
        $request->validate([
            'status' => 'required',
            'rating' => 'required|integer',
            'comment' => 'required|string|max:500',
            'feelings' => 'required'
        ]);

        Review::create([
            'comment' => $request->comment,
            'feelings' => $request->feelings,
            'rating' => $request->rating,
            'status' => $request->status,
            'user_id' => $user_id,
            'anime_id' => $anime_id
        ]);

        // dd($request);
        return redirect()->route('anime.show', ['id' => $anime_id]);
    }

    public function update(Request $request){
        $review_id = $request->input('review_id');
        $anime_id = $request->input('anime_id');
        $request->validate([
            'status'=> 'required',
            'rating'=> 'required'
        ]);

        $review = Review::findorfail($review_id);
        $review->update($request->all());
        // dd($request);
        return redirect()->route('anime.show', ['id'=> $anime_id]);
    }

    public function get($id){
        $review = Review::findOrFail($id);
        $user = User::findOrFail($review -> user_id);
        $anime = Anime::findOrFail($review -> anime_id);

        // Changed format of timestamp
        $date = $review->created_at->format('F j, Y');
        $review -> created_at = $date;

        return view('review.show', compact('review', 'user', 'anime', 'date'));
    }

    public function getAll($id){
        $reviews = DB::table('reviews')
                        ->join('users', 'reviews.user_id', '=', 'users.id')
                        ->join('animes', 'reviews.anime_id', '=', 'animes.id')
                        ->select([
                            'reviews.id as reviewId',
                            'reviews.comment',
                            DB::raw('DATE_FORMAT(reviews.created_at, "%M %e, %Y") as created_at'),
                            'animes.id as anime_id',
                            'users.name',
                            'users.profile_picture'
                        ])
                        ->where('animes.id', $id)
                        ->orderBy('reviews.created_at', 'desc')
                        ->get();
        
        $anime = Anime::findOrFail($id);

        return view('review.show-all', compact('reviews', 'anime'));
    }
}
