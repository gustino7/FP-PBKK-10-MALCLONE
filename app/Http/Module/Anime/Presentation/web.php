<?php

use Illuminate\Support\Facades\Route;

Route::get('ping', function () {
    return csrf_token();
});

Route::post('create_anime', [\App\Http\Module\Anime\Presentation\Controller\AnimeController::class, 'createAnime']);
