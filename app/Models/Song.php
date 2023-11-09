<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "theme_type",
        "singer",
        "anime_id"
    ];

    public function Anime(){
        $this->belongsTo(Anime::class);
    }
}
