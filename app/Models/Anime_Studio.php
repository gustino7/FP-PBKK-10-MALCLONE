<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime_Studio extends Model
{
    protected $table = 'anime_studios';

    use HasFactory;

    protected $fillable = [
        "anime_id",
        "studio_id",
    ];

    public function Anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function Studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
