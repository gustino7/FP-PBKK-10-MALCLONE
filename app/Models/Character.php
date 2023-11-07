<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "voice_actor_id"
    ];

    public function Anime_Character(){
        return $this->hasMany(Character::class);
    }

    public function Voice_Actor(){
        return $this->belongsTo(Voice_Actor::class);
    }
}
