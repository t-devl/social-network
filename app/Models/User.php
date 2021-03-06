<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        "username",
        "email",
        "password",
    ];

    protected $hidden = [
        "password",
    ];

    public function getProfilePictureAttribute($value){
        return $value ? $value : "/images/castle-combe.jpg";
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function following(){
        return $this->belongsToMany(User::class, "follows", "follower_id", "followed_id");
    }

    public function followers(){
        return $this->belongsToMany(User::class, "follows", "followed_id", "follower_id");
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
