@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center gap-4 mb-10">
        <a href="/buku" class="bg-purple-200 p-2 rounded-full cursor-pointer">
            <i data-feather="arrow-left" class="w-6 h-6"></i>
        </a>
        <h1 class="text-4xl font-bold text-gray-800">Detail Buku</h1>
    </div>

    <div class="max-w-4xl w-full flex bg-white rounded-xl shadow-lg gap-8 p-6">
        <img src="{{ asset('storage/' . $book->cover) }}" alt="cover buku" class="w-1/3 rounded-lg">
        <div class="w-full">
            <div class="flex items-center justify-between mb-2 ">
                <div>
                    <span>{{ $book->penulis }}</span>
                    <h3 class="text-2xl font-bold">{{ $book->judul }}</h3>
                </div>
                <a href="/buku/{{ $book->id }}/edit"
                    class="flex items-center text-sm gap-2 bg-[#F1E8FD] hover:bg-[#E0D3F1] transition rounded-lg p-2 text-purple-800 font-semibold w-fit">
                    <i data-feather="edit-2" class="w-4 h-4"></i>
                    <span>Edit Buku</span>
                </a>
            </div>

            <p class="mt-2 whitespace-pre-line leading-snug">{{ $book->deskripsi }}</p>

        </div>
    </div>

    <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg gap-8 p-6 mt-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold">Riwayat Peminjaman</h3>
            <select name="peminjaman" id="" class="bg-[#ECEFF5] p-2 rounded-lg outline-none">
                <option value="">Hari ini</option>
                <option value="">7 Hari yang lalu</option>
                <option value="">30 Hari yang lalu</option>
            </select>
        </div>
        <span>Jumlah Peminjam : 10</span>

    </div>


@endsection
