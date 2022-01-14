<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view ("user.index", ["users" => $users]);
    }

    public function show($id){
        $user = User::find($id);
        $posts = $user->posts()->get();
    
        $followersCount = count($user->followers()->get());
        $followingCount = count($user->following()->get());

        $isFollowed = Auth::user() ? Follow::where("followed_id", $id)->where("follower_id", Auth::user()->id)->exists() : false;

        return view ("user.show", ["user" => $user, "posts" => $posts, "followersCount" => $followersCount, "followingCount" => $followingCount, "isFollowed" => $isFollowed]);
    }

    public function edit(){
        return view("user.edit");   
    }

    public function update(){
        request()->validate([
            "username" => "required|max:20|unique:users,username,".Auth::user()->id,
            "email" => "required|unique:users,email,".Auth::user()->id,
            "password" => "required|min:6",
            "confirmedPassword" => "required|same:password",
        ], [
            "username.unique" => "Username already taken.",
            "username.max" => "Username must not exceed 20 characters.",
            "email.unique" => "Email already in use.",
            "password.min" => "Password must be at least 6 characters.",
            "confirmedPassword" => "Password and confirmed password do not match."
        ]);

        $username = request("username");
        $email = request("email");
        $password = request("password");

        $user = User::find(Auth::user()->id);
        $user->username = $username;
        $user->email = $email;
        $user->$password = $password;

        $user->save();
        return redirect("/users/{{ $user->id }}");
    }
}
