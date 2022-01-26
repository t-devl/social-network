<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilePictureController extends Controller
{
    public function update(){
        $user = User::find(Auth::user()->id);
        $image = request("image");

        $user->profile_picture = $image;
        $user->save();
        return back();
    }
}
