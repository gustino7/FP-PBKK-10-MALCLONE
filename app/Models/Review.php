<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        "comment",
        "feelings",
        "likes",
        "rating",
        "status",
        "user_id",
        "anime_id"
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Anime() {
        return $this->belongsTo(Anime::class);
    }
}
