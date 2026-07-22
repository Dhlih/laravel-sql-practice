<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function show_books()
    {
        $books = DB::select("SELECT id, judul, penulis, cover FROM BOOKS");
        return view("books", ["books" => $books]);
    }
}
