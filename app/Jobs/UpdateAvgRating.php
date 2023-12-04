<?php

namespace App\Jobs;

use App\Models\Anime;
use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAvgRating implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $animes = Anime::all();

        foreach ($animes as $anime) {
            $avg_rating = Review::where('anime_id', $anime->id)->avg('rating');
            if($avg_rating) {
                $anime->update(['avg_rating' => $avg_rating]);
                $anime->save();
            }
        }
    }
}
