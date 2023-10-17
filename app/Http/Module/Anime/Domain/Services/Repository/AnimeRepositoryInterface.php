<?php

namespace App\Http\Module\Anime\Domain\Services\Repository;

use App\Http\Module\Anime\Domain\Model\Anime;

interface AnimeRepositoryInterface
{
    public function save(Anime $anime);

}
