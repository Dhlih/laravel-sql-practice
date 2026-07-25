<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

# Authentication routes
Route::get('/login', [AuthController::class, "show_login"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('/logout', [AuthController::class, "logout"]);

# Dashboard routes
Route::get('/dashboard', function () {
    return view('dashboard');
});

# Books static routes
Route::get('/buku', [App\Http\Controllers\BooksController::class, 'show_books']);
Route::get('/buku/tambah', [App\Http\Controllers\BooksController::class, 'show_create_book']);
Route::post('/buku', [App\Http\Controllers\BooksController::class, 'add_book']);

# Books dynamic routes
Route::get('/buku/{id}', [App\Http\Controllers\BooksController::class, 'show_book']);
Route::put('/buku/{id}', [App\Http\Controllers\BooksController::class, 'edit_book']);
Route::get('/buku/{id}/edit', [App\Http\Controllers\BooksController::class, 'show_edit_book']);
Route::get('/buku/{id}/edit', [App\Http\Controllers\BooksController::class, 'show_edit_book']);

