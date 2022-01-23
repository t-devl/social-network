<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $followedUsers = $user->following()->get();
        return view("following.index", ["user" => $user, "followedUsers" => $followedUsers]);
    }
}
