<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'anime';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'rating'
    ];

}
