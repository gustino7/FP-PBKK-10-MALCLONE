<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "established",
        "description"
    ];

    public function Anime_Studio(){
        return $this->hasMany(Studio::class);
    }
}
