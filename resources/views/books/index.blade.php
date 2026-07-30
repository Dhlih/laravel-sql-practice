@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="w-full md:flex items-center justify-between md:mb-10 mb-8 ">
        <h1 class="md:text-4xl text-3xl  font-bold text-gray-800">Buku</h1>

        <form action="/buku" method="GET" class="md:max-w-xs w-full flex items-center gap-4 md:mt-0 mt-4">
            <input type="text" name="judul" placeholder="Ketik judul buku..."
                class="w-full bg-white p-2 rounded-lg outline-none shadow-lg" value="{{ request('judul') }}">

            <button type="submit"
                class="bg-[#F1E8FD] p-2 px-4 rounded-lg font-semibold shadow-lg hover:bg-[#E5D5FC] transition cursor-pointer">
                <i data-feather="search"></i>
            </button>
        </form>
    </div>
{{-- -m-3 --}}
    <div class="flex flex-wrap bg-white rounded-xl shadow-lg ">
        @foreach ($books as $book)
            <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 p-6">
                <div class="w-full flex flex-col items-center">
                    <a href="/buku/{{ $book->id }}">
                        <img src="{{ asset('storage/' . $book->cover) }}"
                            class="w-full aspect-[3/4] object-cover rounded-lg hover:scale-105 transition duration-300" alt="{{ $book->judul }}">
                    </a>
                    <div class="mt-4 text-center">
                        <h3 class="md:text-xl text-lg font-semibold">{{ Str::limit($book->judul, 13) }}</h3>
                        <p class="text-gray-500 ">{{  Str::limit($book->penulis, 13) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <a href="/buku/tambah"
        class="bg-[#E5D5FC] rounded-full p-3 font-semibold shadow-lg hover:bg-[#F1E8FD] transition cursor-pointer fixed bottom-10 right-10">
        <i data-feather="plus" class="w-8 h-8"></i>
    </a>
@endsection
