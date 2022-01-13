<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function index($id){
        $users = User::find($id)->following()->get();
        $followedUsers = Auth::user() ? User::find(Auth::user()->id)->following()->pluck("id")->toArray() : [];
        return view("following.index", ["users" => $users, "followedUsers" => $followedUsers]);
    }
}
