<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view ("register.create");
    }

    public function store(){
        request()->validate([
            "username" => "required|max:20|unique:users",
            "email" => "required|unique:users",
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

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        User::create(["username" => $username, "email" => $email, "password" => $hashedPassword]);

        return redirect("/login");
    }
}
