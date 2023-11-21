<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function show($anime_id, $user_id){
        $anime = Anime::findorfail($anime_id);
        $review = Review::where('user_id', $user_id)->where('anime_id', $anime->id)->value('id');
        // Log::info("anime-id", $anime->toArray());
        // Log::info("review-id", $review->toArray());

        if($review){
            return view('review.already-review');
        }else{
            return view('review.create', compact('anime'));
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
}
