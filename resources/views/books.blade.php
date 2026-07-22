@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-4xl font-bold text-gray-800">Buku</h1>

        <div class="flex items-center gap-4 ">
            <input type="text" placeholder="Ketik judul buku..."
                class="max-w-xl w-full bg-white p-2 rounded-lg outline-none">
            <select class="bg-white p-2 rounded-lg outline-none">
                <option value="test">Test</option>
                <option value="test2">Test 2</option>
                <option value="test3">Test 3</option>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap -m-3 bg-white p-2 rounded-xl shadow-lg ">
        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>



        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6 ">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-6">
            <div class="w-full flex flex-col items-center">
                <img src="book.jpg" class="w-full aspect-[3/4] object-cover rounded-lg" alt="The Alchemist">
                <div class="mt-2 text-center">
                    <h3 class="text-lg font-semibold">The Alchemist</h3>
                    <p class="text-gray-500">Paulo Coelho</p>
                </div>
            </div>
        </div>

    </div>
@endsection
