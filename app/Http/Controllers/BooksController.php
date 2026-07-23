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

    public function add_book(Request $request)
    {
        $judul = $request->input("judul");
        $penulis = $request->input("penulis");
        $deskripsi = $request->input("deskripsi");
        $cover = $request->file("cover");

        $file_name = time() . "_" . $cover->getClientOriginalName();
        $cover_path = $cover->storeAs("public/covers", $file_name, "public");

        DB::insert("INSERT INTO BOOKS (judul, penulis, deskripsi, cover) VALUES (?, ?, ?, ?)", [$judul, $penulis, $deskripsi, $cover_path]);
        return redirect("/buku");
    }
}
