<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'rating' => $this->faker->randomFloat(2, 0, 10),
            'synopsis' => $this->faker->paragraph,
            'poster' => $this->faker->imageUrl(300, 400),
            'type' => $this->faker->randomElement(['TV', 'Movie', 'OVA']),
            'episode' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['Airing', 'Finished', 'Not Yet Aired']),
            'premiered' => $this->faker->date,
        ];
    }
}
