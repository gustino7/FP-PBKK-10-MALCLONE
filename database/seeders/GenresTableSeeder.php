<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            'Action',
            'Adventure',
            'Avant Garde',
            'Award Winning',
            'Boys Love',
            'Comedy',
            'Drama',
            'Fantasy',
            'Girls Love',
            'Gourmet',
            'Horror',
            'Mystery',
            'Romance',
            'Sci-Fi',
            'Slice of Life',
            'Sports',
            'Supernatural',
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
