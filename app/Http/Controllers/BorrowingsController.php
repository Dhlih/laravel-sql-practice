<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingsController extends Controller
{
    public function show_borrowings(Request $request)
    {
        $book_title = $request->input("judul");
        if ($book_title) {
            $borrowings = DB::select("SELECT br.id, mb.nama AS nama_peminjam, bk.judul AS judul_buku, br.tanggal_pinjam, br.tanggal_kembali_seharusnya, status FROM BORROWINGS br 
            JOIN MEMBERS mb on br.member_id = mb.id 
            JOIN BOOKS bk on br.book_id = bk.id WHERE bk.judul LIKE ?", ["%$book_title%"]);
        } else {
            $borrowings = DB::select("SELECT br.id, mb.nama AS nama_peminjam, bk.judul AS judul_buku, br.tanggal_pinjam, br.tanggal_kembali_seharusnya, status FROM BORROWINGS br
            JOIN MEMBERS mb on br.member_id = mb.id
            JOIN BOOKS bk on br.book_id = bk.id");
        }
        return view("borrowings.index", ["borrowings" => $borrowings]);
    }

    public function show_borrowing($id)
    {
        // Mengambil detail 1 peminjaman berdasarkan ID
        $borrowing = DB::selectOne("
        SELECT 
            br.id, 
            mb.nama AS nama_peminjam, 
            mb.kode_member,
            mb.telepon,
            bk.judul AS judul_buku, 
            bk.penulis,
            bk.cover,
            br.tanggal_pinjam, 
            br.tanggal_kembali_seharusnya, 
            br.tanggal_kembali_aktual,
            br.denda,
            br.status 
        FROM BORROWINGS br 
        JOIN MEMBERS mb ON br.member_id = mb.id 
        JOIN BOOKS bk ON br.book_id = bk.id 
        WHERE br.id = ?
    ", [$id]);

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$borrowing) {
            abort(404);
        }

        return view("borrowings.show", ["borrowing" => $borrowing]);
    }

    public function add_borrowing(Request $request)
    {
        $validated = $request->validate([
            'id_member' => 'required|exists:MEMBERS,id',
            'id_buku' => 'required|exists:BOOKS,id',
            'tanggal_pinjam' => 'required|date',
            'tenggat_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $member_id = $validated['id_member'];
        $book_id = $validated['id_buku'];
        $tanggal_pinjam = $validated['tanggal_pinjam'];
        $tenggat_kembali = $validated['tenggat_kembali'];

        try {
            DB::insert("INSERT INTO BORROWINGS (member_id, book_id, tanggal_pinjam, tanggal_kembali_seharusnya, status) VALUES (?, ?, ?, ?, ?)", [$member_id, $book_id, $tanggal_pinjam, $tenggat_kembali, 'dipinjam']);
            return redirect("/peminjaman");
        } catch (\Exception $e) {
            dd("error", $e);
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan peminjaman.']);
        }
    }
}
