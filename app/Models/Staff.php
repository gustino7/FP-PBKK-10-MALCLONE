<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'description',
        'profile_picture',
    ];

    public function Anime_Staff()
    {
        return $this->hasMany(Anime_Staff::class);
    }

    public function Position_Staff()
    {
        return $this->belongsTo(Position_Staff::class);
    }
}
