<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["middleware" => "auth"], function(){
    Route::get("/", FeedController::class);
    Route::post("/logout", [LoginController::class, "destroy"]);
    Route::get("/users/edit", [UserController::class, "edit"]);
    Route::post("/users/edit", [UserController::class, "update"]);
    Route::post("/picture", [ProfilePictureController::class, "update"]);
    Route::get("/posts/create", [PostController::class, "create"]);
    Route::post("/posts", [PostController::class, "store"]);
    Route::post("/likes/{id}", [LikeController::class, "store"]);
    Route::delete("/likes/{id}", [LikeController::class, "destroy"]);
    Route::post("/follow", [FollowController::class, "store"]);
    Route::delete("/follow", [FollowController::class, "destroy"]);
});
Route::get("/users", [UserController::class, "index"]);
Route::get("/users/{id}", [UserController::class, "show"]);
Route::get("/users/{id}/following", [FollowingController::class, "index"]);
Route::get("/users/{id}/followers", [FollowerController::class, "index"]);
Route::get("/users/{id}/likes", [LikeController::class, "index"]);
Route::get("/register", [RegisterController::class, "create"]);
Route::post("/register", [RegisterController::class, "store"]);
Route::get("/login", [LoginController::class, "create"])->name("login");
Route::post("/login", [LoginController::class, "store"]);
Route::get("/posts", [PostController::class, "index"]);


