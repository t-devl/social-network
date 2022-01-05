<?php

use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('index');
});

Route::get("/users", [UserController::class, "index"]);

Route::get("/register", [RegisterController::class, "create"]);
    
Route::post("/register", [RegisterController::class, "store"]);

Route::get("/login", [LoginController::class, "create"]);

Route::post("/login", [LoginController::class, "store"]);

Route::post("/logout", [LoginController::class, "destroy"]);

Route::get("/users/{id}", [UserController::class, "show"]);
