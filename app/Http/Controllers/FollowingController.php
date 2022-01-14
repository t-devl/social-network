<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function index($id){
        $users = User::find($id)->following()->get();
        return view("following.index", ["users" => $users]);
    }
}
