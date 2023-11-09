<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position_Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function Staff(){
        return $this->hasOne(Staff::class);
    }
}
