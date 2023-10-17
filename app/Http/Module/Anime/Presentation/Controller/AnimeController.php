<?php

namespace App\Http\Module\Anime\Presentation\Controller;

use App\Http\Module\Anime\Application\Services\CreateAnime\CreateAnimeRequest;
use App\Http\Module\Anime\Application\Services\CreateAnime\CreateAnimeService;
use Illuminate\Http\Request;

class AnimeController
{
    public function __construct(
        private CreateAnimeService $create_anime_service
    ) {
    }

    public function createAnime(Request $request)
    {
        $request = new CreateAnimeRequest(
            $request->input('title'),
            $request->input('rating'),
            $request->input('description'),
        );

        return $this->create_anime_service->execute($request);
    }
}
