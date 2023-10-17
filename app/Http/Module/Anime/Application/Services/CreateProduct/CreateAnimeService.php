<?php

namespace App\Http\Module\Anime\Application\Services\CreateAnime;

use App\Http\Module\Anime\Domain\Model\Anime;
use App\Http\Module\Anime\Domain\Services\Repository\AnimeRepositoryInterface;

class CreateAnimeService
{

    public function __construct(
        private AnimeRepositoryInterface $anime_repository
    ) {
    }

    public function execute(CreateAnimeRequest $request)
    {
        $anime = new Anime(
            $request->title,
            $request->rating,
            $request->description,
        );

        $this->anime_repository->save($anime);
    }
}
