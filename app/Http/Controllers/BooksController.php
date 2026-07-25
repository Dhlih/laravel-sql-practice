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

    public function show_book(string $id)
    {

        $book = DB::selectOne("SELECT id, judul, deskripsi, penulis, cover FROM BOOKS WHERE id = ?", [$id]);
        if (!$book) {
            abort(404);
        }
        return view("books.show", ["book" => $book]);
    }

    public function show_edit_book(string $id)
    {
        $book = DB::selectOne("SELECT id, judul, deskripsi, penulis, cover FROM BOOKS WHERE id = ?", [$id]);
        return view("books.edit", ["book" => $book]);
    }

    public function edit_book(Request $request, string $id)
    {
        $old_book = DB::selectOne("SELECT judul, penulis, deskripsi, cover FROM BOOKS WHERE id =?", [$id]);

        $judul = $request->input("judul") ?? $old_book->judul;
        $penulis = $request->input("penulis") ?? $old_book->penulis;
        $deskripsi = $request->input("deskripsi") ?? $old_book->deskripsi;
        $cover = $request->file("cover");

        if ($cover) {
            $file_name = time() . "_" . $cover->getClientOriginalName();
            $cover_path = $cover->storeAs("public/covers", $file_name, "public");
        } else {
            $cover_path = $old_book->cover;
        }

        DB::update("UPDATE BOOKS SET judul = ?, penulis = ?, deskripsi = ?, cover = ? WHERE id = ?", [$judul, $penulis, $deskripsi, $cover_path, $id]);
        return redirect("/buku/$id");
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
