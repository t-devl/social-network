<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view("login.create");
    }

    public function store(){
        request()->validate([
            "uid" => "required|exists:users,username",
            "password" => "required",
        ], [
            "uid.exists" => "Invalid username or email.",
        ]);

        $uid = request("uid");
        $password = request("password");

        if(filter_var($uid, FILTER_VALIDATE_EMAIL)){
            $credentials = ["email" => $uid, "password" => $password];
        }
        else{
            $credentials = ["username" => $uid, "password" => $password];
        }

        if(Auth::attempt($credentials)){
            return redirect()->intended();
        }
        else{
            $errors = [
                "password" => "Incorrect password.",
            ];
            return back()->withErrors($errors)->withInput();
        }

    }

    public function destroy(){
        Auth::logout();
        return redirect("/");
    }
}
