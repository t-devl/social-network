<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $followers = $user->followers()->get();
        return view("follower.index", ["user" => $user, "followers" => $followers]);
    }
}
