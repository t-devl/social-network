<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $likes = $user->likes()->pluck("post_id")->toArray();
        $posts = Post::whereIn("id", $likes)->get(); 

        foreach($posts as $post){
            $likes = $post->likes()->pluck("user_id")->toArray();
            $post->likes = $likes;
        }

        return view("like.index", ["user" => $user, "posts" => $posts]);
    }

    public function store($id){
        $userId = Auth::user()->id;
        $postId = $id;

        Like::create(["user_id" => $userId, "post_id" => $postId]);
        return back();
    }

    public function destroy($id){
        Like::where("post_id", $id)->where("user_id", Auth::user()->id)->delete();
        return back();
    }
}
