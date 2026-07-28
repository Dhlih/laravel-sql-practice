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
}
