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
        $user = User::find(Auth::user()->id);
        $following = $user->following()->pluck("followed_id")->toArray();      
        $posts = Post::whereIn("user_id", $following)->orWhere("user_id", $user->id)->orderBy("created_at", "DESC")->get();

        return view("index", ["posts" => $posts]);
    }
}
