@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center gap-4 md:mb-10 mb-8">
        <a href="/buku"
            class="w-10 h-10 bg-white hover:bg-[#F1E8FD] text-gray-700 hover:text-purple-700 rounded-xl shadow-md flex items-center justify-center transition-all duration-200 cursor-pointer">
            <i data-feather="arrow-left" class="w-5 h-5"></i>
        </a>
        <h1 class="md:text-4xl text-3xl font-bold text-gray-800">Detail Buku</h1>
    </div>

    <div class="max-w-5xl relative w-full flex md:flex-row flex-col bg-white rounded-xl shadow-lg gap-8 p-6">
        <img src="{{ asset('storage/' . $book->cover) }}" alt="cover buku"
            class="md:w-1/3 md:h-1/3 w-full aspect-[3/4] rounded-lg">
        <div class="w-full">
            <div>
                <span class="text-lg ">{{ $book->penulis }}</span>
                <h3 class="text-2xl font-bold">{{ $book->judul }}</h3>
            </div>
            <p class="mt-2 whitespace-pre-line leading-snug opacity-85">{{ $book->deskripsi }}</p>
        </div>
    </div>

    <a href="/buku/{{ $book->id }}/edit"
        class="bg-[#E5D5FC] rounded-full p-3 font-semibold shadow-lg hover:bg-[#F1E8FD] transition cursor-pointer fixed bottom-10 right-10">
        <i data-feather="edit-2" class="w-8 h-8"></i>
    </a>
@endsection
