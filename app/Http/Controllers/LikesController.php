<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
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
