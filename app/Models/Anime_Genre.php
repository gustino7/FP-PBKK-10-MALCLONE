<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime_Genre extends Model
{
    protected $table = 'anime_genres';

    use HasFactory;

    protected $fillable = [
        "anime_id",
        "genre_id",
    ];

    public function Anime(){
        return $this->belongsTo(Anime::class);
    }

    public function Genre(){
        return $this->belongsTo(Genre::class);
    }
}
