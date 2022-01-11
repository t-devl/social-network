<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function index($id){
        $users = User::find($id)->followers()->get();
        $followedUsers = Auth::user() ? User::find(Auth::user()->id)->following()->pluck("id")->toArray() : [];
        return view("follower.index", ["users" => $users, "followedUsers" => $followedUsers]);
    }
}
