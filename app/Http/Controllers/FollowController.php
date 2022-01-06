<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(){
        $followedId = request("followedId");
        Follow::create(["followed_id" => $followedId, "follower_id" => Auth::user()->id]);
        return back();
    }

    public function destroy(){
        $followedId = request("followedId");
        Follow::where("followed_id", $followedId)->where("follower_id", Auth::user()->id)->delete();
        return back();
    }
}
