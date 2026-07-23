<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class BooksController extends Controller
{
    public function show_books(Request $request)
    {
        $book_title = $request->input("judul");
        if ($book_title) {
            $books = DB::select("SELECT id, judul, penulis, cover FROM BOOKS WHERE judul LIKE ?", ["%$book_title%"]);
        } else {
            $books = DB::select("SELECT id, judul, penulis, cover FROM BOOKS");
        }
        return view("books.index", ["books" => $books]);
    }

    public function show_create_book()
    {
        return view("books.create");
    }
}
