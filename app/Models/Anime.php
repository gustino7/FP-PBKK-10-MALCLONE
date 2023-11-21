<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "avg_rating",
        "synopsis",
        "poster",
        "type",
        "episode",
        "status",
        "premiered",
        "season"
    ];

    public function Song()
    {
        return $this->hasMany(Song::class);
    }

    public function User_Anime()
    {
        return $this->hasMany(User_Anime::class);
    }

    public function Anime_Character()
    {
        return $this->hasMany(Anime_Character::class);
    }

    public function Anime_Genre()
    {
        return $this->hasMany(Anime_Genre::class);
    }

    public function Anime_Staff()
    {
        return $this->hasMany(Anime_Staff::class);
    }

    public function Anime_Studio()
    {
        return $this->hasMany(Anime_Studio::class);
    }
}
