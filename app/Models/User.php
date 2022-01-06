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

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
