<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if (!$old_book) {
            abort(404, "Buku tidak ditemukan");
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $file_name = time() . "_" . $validated['cover']->getClientOriginalName();
            try {
                $cover_path = $validated['cover']->storeAs("covers", $file_name, "public");

                if ($old_book->cover && Storage::disk('public')->exists($old_book->cover)) {
                    Storage::disk('public')->delete($old_book->cover);
                }
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['cover' => 'Gagal mengunggah cover buku']);
            }
        } else {
            $cover_path = $old_book->cover;
        }

        try {
            DB::update("UPDATE BOOKS SET judul = ?, penulis = ?, deskripsi = ?, cover = ? WHERE id = ?", [$validated['judul'], $validated['penulis'], $validated['deskripsi'], $cover_path, $id]);
            return redirect("/buku/$id");
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['cover' => 'Gagal mengedit buku']);
        }
    }

    public function add_book(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'cover' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $file_name = time() . "_" . $validated['cover']->getClientOriginalName();

        try {
            $cover_path = $validated['cover']->storeAs("public/covers", $file_name, "public");
            DB::insert("INSERT INTO BOOKS (judul, penulis, deskripsi, cover) VALUES (?, ?, ?, ?)", [$validated['judul'], $validated['penulis'], $validated['deskripsi'], $cover_path]);
            return redirect("/buku");
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['cover' => 'Gagal menambahkan buku']);
        }
    }

    public function delete_book(string $id)
    {
        try {
            DB::delete("DELETE FROM BOOKS WHERE id = ?", [$id]);
            return redirect("/buku");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus buku']);
        }
    }

    public function search_books(Request $request) {
        $query = $request->query('q', '');
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        $books = DB::select("SELECT id, judul, penulis FROM BOOKS WHERE judul LIKE ? LIMIT 5", ["%$query%"]);
        return response()->json($books);
    }
}
