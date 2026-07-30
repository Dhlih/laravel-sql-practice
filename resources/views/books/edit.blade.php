@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center gap-4 mb-10">
        <a href="/buku/{{ $book->id }}"
            class="w-10 h-10 bg-white hover:bg-[#F1E8FD] text-gray-700 hover:text-purple-700 rounded-xl shadow-md flex items-center justify-center transition-all duration-200 cursor-pointer">
            <i data-feather="arrow-left" class="w-5 h-5"></i>
        </a>
        <h1 class="md:text-4xl text-3xl  font-bold text-gray-800">Edit Buku</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 lg:max-w-2xl w-full">
        <form action="/buku/{{ $book->id }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-4 w-full">
            @csrf
            @method('PUT')
            <div class="flex md:flex-row flex-col items-center gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="judul" class="font-semibold">Judul Buku</label>
                    <input type="text" name="judul" placeholder="Judul Buku"
                        class="w-full bg-[#ECEFF5] p-2 rounded-lg outline-none" value="{{ $book->judul }}">
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="penulis" class="font-semibold">Penulis Buku</label>
                    <input type="text" name="penulis" placeholder="Penulis Buku"
                        class="w-full bg-[#ECEFF5] p-2 rounded-lg outline-none" value="{{ $book->penulis }}">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="deskripsi" class="font-semibold">Deskripsi Buku</label>
                <textarea name="deskripsi" rows="4" placeholder="Deskripsi Buku"
                    class="w-full bg-[#ECEFF5] p-2 rounded-lg outline-none resize-none">{{ $book->deskripsi }}</textarea>
            </div>
            <div class="flex flex-col gap-2">
                <label class="font-semibold">Cover Buku</label>
                <label for="cover" id="upload-placeholder"
                    class="flex flex-col justify-center items-center rounded-lg border-2 border-dashed border-gray-300 cursor-pointer">
                    <img id="cover-preview" src="{{ asset('storage/' . $book->cover) }}" alt="Preview Cover"
                        class="w-full h-full object-cover">
                </label>

                <input type="file" name="cover" id="cover" placeholder="Cover Buku" class="hidden" accept="image/*"
                    onchange="previewImage(event)">

            </div>
            <button type="submit" class="bg-[#F1E8FD] rounded-xl p-3 mt-2 font-bold hover:bg-[#E0D3F1] cursor-pointer">Edit
                Buku</button>
        </form>
        <form action="/buku/{{ $book->id }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full bg-red-400 rounded-xl p-3 mt-2 font-bold hover:bg-red-500 cursor-pointer">Hapus
                Buku</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('cover-preview');

            if (input.files && input.files[0]) {
                // Membuat URL sementara dari file yang dipilih
                const imageUrl = URL.createObjectURL(input.files[0]);

                // Pasang URL ke atribut src elemen <img>
                preview.src = imageUrl;
            }
        }
    </script>
@endsection
