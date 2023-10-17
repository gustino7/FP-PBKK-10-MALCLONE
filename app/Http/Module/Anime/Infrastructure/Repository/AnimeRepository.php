<?php

namespace App\Http\Module\Anime\Infrastructure\Repository;

use App\Http\Module\Anime\Domain\Model\Anime;
use App\Http\Module\Anime\Domain\Services\Repository\AnimeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnimeRepository implements AnimeRepositoryInterface
{
    public function save(Anime $anime)
    {
        DB::table('animes')->upsert(
            [
                'title' => $anime->title,
                'rating' => $anime->rating,
                'description' => $anime->description,
            ],
            'title'
        );
    }
}
