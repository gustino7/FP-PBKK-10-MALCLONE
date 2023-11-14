<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    public function definition(): array
    {
        $premieredDate = $this->faker->date;
        $season = $this->getSeason($premieredDate);

        return [
            'title' => $this->faker->sentence,
            'avg_rating' => $this->faker->randomFloat(2, 0, 10),
            'synopsis' => $this->faker->paragraph,
            'poster' => $this->faker->imageUrl(300, 400),
            'type' => $this->faker->randomElement(['TV', 'Movie', 'OVA']),
            'episode' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['Airing', 'Finished', 'Not Yet Aired']),
            'premiered' => $premieredDate,
            'season' => $season,
        ];
    }

    private function getSeason($premieredDate): string
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $premieredDate);
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        if ($month >= 1 && $month <= 3) {
            return "Winter $year";
        } elseif ($month >= 4 && $month <= 6) {
            return "Spring $year";
        } elseif ($month >= 7 && $month <= 9) {
            return "Summer $year";
        } elseif ($month >= 10 && $month <= 12) {
            return "Fall $year";
        } else {
            return "Unknown Season";
        }
    }
}
