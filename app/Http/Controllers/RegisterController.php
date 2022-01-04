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
        $username = request("username");
        $email = request("email");
        $password = request("password");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        User::create(["username" => $username, "email" => $email, "password" => $hashedPassword]);

        return redirect("/login");
    }
}
