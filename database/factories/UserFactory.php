<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt($this->faker->password), // generate a random password
            'profile_picture' => null,
            'description' => null,
            'is_premium' => 0,
            'wallpaper' => null,
        ];
    }

    /**
     * Define the state for the user with specific details.
     *
     * @return \Database\Factories\Factory
     */
    public function amogus(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'amogus69',
                'email' => 'amogus69@gmail.com',
                'password' => bcrypt('amogus69'),
            ];
        });
    }
}
