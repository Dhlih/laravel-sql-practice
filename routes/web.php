<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

# Authentication routes
Route::get('/login', function () {
    return view("login");
});
Route::post('/login', [AuthController::class, "login"]);
Route::post('/logout', [AuthController::class, "logout"]);

Route::get('/dashboard', function () {
    return view('dashboard');
});
