<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function index($id){
        $users = User::find($id)->followers()->get();
        return view("follower.index", ["users" => $users]);
    }
}
