<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        return view("post.create");
    }

    public function store(){
        request()->validate([
            "text" => "required",
        ]);

        $text = request("text");
        $userId = request("userId");

        Post::create(["text" => $text, "user_id" => $userId]);

        return redirect("/");
    }
}
