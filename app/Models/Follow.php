<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        "followed_id",
        "follower_id",
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
