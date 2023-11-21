<?php

namespace App\Console\Commands;

use App\Models\Anime;
use App\Models\Review;
use Illuminate\Console\Command;

class UpdateAvgRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:avg-rating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update table anime column avg_rating in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $animes = Anime::all();

        foreach ($animes as $anime) {
            $avg_rating = Review::where('anime_id', $anime->id)->avg('rating');
            if($avg_rating) {
                $anime->update(['avg_rating' => $avg_rating]);
                $anime->save();
                // $this->info("Updated rating for anime {$anime->id} to {$avg_rating}");
            }
        }
        $this->info('All anime ratings updated successfully.');
    }
}
