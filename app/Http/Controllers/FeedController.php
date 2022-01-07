<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function __invoke()
    {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            $following = $user->following()->pluck("id")->toArray();      
            $posts = Post::whereIn("user_id", $following)->orWhere("user_id", $user->id)->orderBy("created_at", "DESC")->get();
        }
        else{
            $posts = [];
        }
        return view("index", ["posts" => $posts]);
    }
}
