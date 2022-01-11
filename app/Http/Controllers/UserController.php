<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $followedUsers = Auth::user() ? User::find(Auth::user()->id)->following()->pluck("id")->toArray() :  [];
          
        return view ("user.index", ["users" => $users, "followedUsers" => $followedUsers]);
    }

    public function show($id){
        $user = User::find($id);
        $posts = $user->posts()->get();
  
        foreach($posts as $post){
            $likes = $post->likes()->pluck("user_id")->toArray();
            $post->likes = $likes;
        }
    
        $followersCount = count($user->followers()->get());
        $followingCount = count($user->following()->get());

        $isFollowed = Auth::user() ? Follow::where("followed_id", $id)->where("follower_id", Auth::user()->id)->exists() : false;

        return view ("user.show", ["user" => $user, "posts" => $posts, "followersCount" => $followersCount, "followingCount" => $followingCount, "isFollowed" => $isFollowed]);
    }
}
