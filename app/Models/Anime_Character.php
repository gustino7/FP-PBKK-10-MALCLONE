<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime_Character extends Model
{
    use HasFactory;

    protected $table = 'anime_characters';
    
    protected $fillable = [
        "anime_id",
        "character_id",
    ];

    public function Anime(){
        return $this->belongsTo(Anime::class);
    }

    public function Character(){
        return $this->belongsTo(Character::class);
    }
}
