@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-4xl font-bold text-gray-800">Buku</h1>

        <form action="/buku" method="GET" class="max-w-sm w-full flex items-center gap-4 ">
            <input type="text" name="judul" placeholder="Ketik judul buku..."
                class="w-full bg-white p-2 rounded-lg outline-none shadow-lg" value="{{ request('judul') }}">

            <select class="bg-white p-2 rounded-lg outline-none shadow-lg">
                <option value="test">Test</option>
                <option value="test2">Test 2</option>
                <option value="test3">Test 3</option>
            </select>

            <button type="submit"
                class="bg-[#F1E8FD] p-2 px-4 rounded-lg font-semibold shadow-lg hover:bg-[#E5D5FC] transition cursor-pointer">
                <i data-feather="search"></i>

            </button>
        </form>

    </div>

    <div class="flex flex-wrap -m-3 bg-white rounded-xl shadow-lg ">
        @foreach ($books as $book)
            <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 p-6">
                <div class="w-full flex flex-col items-center">
                    <img src={{ $book->cover }} class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                    <div class="mt-4 text-center">
                        <h3 class="text-xl font-semibold">{{ $book->judul }}</h3>
                        <p class="text-gray-500 ">{{ $book->penulis }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <a href="/buku/tambah"
        class="bg-[#E5D5FC] rounded-full p-3 font-semibold shadow-lg hover:bg-[#F1E8FD] transition cursor-pointer absolute bottom-10 right-10">
        <i data-feather="plus" class="w-8 h-8"></i>
    </a>
@endsection
