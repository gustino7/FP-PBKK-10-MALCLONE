<?php

namespace App\Http\Module\Anime\Domain\Model;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Anime
{
    /**
     * @param string $title
     * @param float $rating
     * @param string $description
     */
    public function __construct(
        public string $title,
        public float $rating,
        public string $description,
    ) {
    }
}
