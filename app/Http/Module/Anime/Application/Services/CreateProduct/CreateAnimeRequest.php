<?php

namespace App\Http\Module\Anime\Application\Services\CreateAnime;

class CreateAnimeRequest
{
    public function __construct(
        public string $title,
        public float $rating,
        public string $description,
    ) {
    }
}
