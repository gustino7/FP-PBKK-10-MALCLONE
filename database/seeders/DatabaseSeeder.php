<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Anime;
use App\Models\Character;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
        ]);
        Anime::factory()
            ->count(20)
            ->create();
        Character::factory(20)->create();
        User::factory()->amogus()->create();
    }
}
