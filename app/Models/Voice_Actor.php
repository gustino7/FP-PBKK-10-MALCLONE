<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voice_Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'language',
        'description',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
