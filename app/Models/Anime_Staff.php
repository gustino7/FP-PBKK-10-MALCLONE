<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime_Staff extends Model
{
    use HasFactory;

    protected $table = 'anime_staff';

    protected $fillable = [
        "anime_id",
        "staff_id",
        'role',
    ];

    public function Anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
