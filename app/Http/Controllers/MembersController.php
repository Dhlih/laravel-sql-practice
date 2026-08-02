<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MembersController extends Controller
{
    private function generate_kode_member()
    {
        do {
            $kode = "MBR-" . strtoupper(Str::random(6));
            $exists = DB::selectOne("SELECT id FROM MEMBERS WHERE kode_member = ?", [$kode]);
        } while ($exists);
        return $kode;
    }

    public function show_members(Request $request)
    {
        $member_name = $request->input("nama");
        if ($member_name) {
            $members = DB::select("SELECT id, kode_member, nama, telepon FROM MEMBERS WHERE nama LIKE ?", ["%$member_name%"]);
        } else {
            $members = DB::select("SELECT id, kode_member, nama, telepon FROM MEMBERS");
        }
        return view("members.index", ["members" => $members]);
    }

    public function edit_member(Request $request, string $id)
    {
        $old_member = DB::selectOne("SELECT nama, telepon FROM MEMBERS WHERE id =?", [$id]);
        if (!$old_member) {
            abort(404);
        }

        $validated = $request->validate([
            "nama" => "required|string|max:255",
            "telepon" => "required|string|max:20"
        ]);

        try {
            DB::update("UPDATE MEMBERS SET nama = ?, telepon = ? WHERE id = ?", [$validated['nama'], $validated['telepon'], $id]);
            return redirect("/anggota");
        } catch (\Exception $e) {
            return redirect("/anggota")->withErrors(['error' => 'Gagal mengedit anggota. Silakan coba lagi.']);
        }
    }

    public function add_member(Request $request)
    {
        $validated = $request->validate([
            "nama" => "required|string|max:255",
            "telepon" => "required|string|max:20"
        ]);
        $kode_member = $this->generate_kode_member();
        try {
            DB::insert("INSERT INTO MEMBERS (nama, telepon, kode_member) VALUES (?, ?, ?)", [$validated['nama'], $validated['telepon'], $kode_member]);
            return redirect("/anggota");
        } catch (\Exception $e) {
            return redirect("/anggota")->withErrors(['error' => 'Gagal menambahkan anggota. Silakan coba lagi.']);
        }
    }

    public function delete_member(string $id)
    {
        $member = DB::selectOne("SELECT id FROM MEMBERS WHERE id = ?", [$id]);
        if (!$member) {
            abort(404);
        }
        try {
            DB::delete("DELETE FROM MEMBERS WHERE id = ?", [$id]);
            return redirect("/anggota");
        } catch (\Exception $e) {
            return redirect("/anggota")->withErrors(['error' => 'Gagal menghapus anggota. Silakan coba lagi.']);
        }
    }

    public function search_members(Request $request)
    {
        $query = $request->query('q', '');
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        $members = DB::select("SELECT id, nama FROM MEMBERS WHERE nama LIKE ? LIMIT 5", ["%$query%"]);
        return response()->json($members);
    }
}
