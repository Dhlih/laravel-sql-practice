@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center gap-4 mb-10">
        <a href="/buku" class="bg-purple-200 p-2 rounded-full cursor-pointer">
            <i data-feather="arrow-left" class="w-6 h-6"></i>
        </a>
        <h1 class="text-4xl font-bold text-gray-800">Tambah Buku</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 flex gap-8 max-w-2xl w-full">
        <form action="/buku" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 w-full">
            <div class="flex items-center gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="judul" class="font-semibold">Judul Buku</label>
                    <input type="text" name="judul" placeholder="Judul Buku"
                        class="w-full bg-[#ECEFF5] p-2 rounded-lg outline-none">
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="penulis" class="font-semibold">Penulis Buku</label>
                    <input type="text" name="penulis" placeholder="Penulis Buku"
                        class="w-full bg-[#ECEFF5] p-2 rounded-lg outline-none">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="deskripsi" class="font-semibold">Deskripsi Buku</label>
                <textarea name="deskripsi" rows="4" placeholder="Deskripsi Buku"
                    class="w-full bg-[#ECEFF5] p-2 rounded-lg outline-none resize-none"></textarea>
            </div>
            <div class="flex flex-col gap-2">
                <label class="font-semibold">Cover Buku</label>
                <label for="cover" id="upload-placeholder"
                    class="flex flex-col justify-center items-center rounded-lg h-32 border-2 border-dashed border-gray-300 cursor-pointer">
                    <i data-feather="upload" class="w-6 h-6"></i>
                    <p class="text-sm text-gray-500">
                        <span class="font-bold text-purple-600">Klik untuk upload</span> atau tarik gambar ke sini
                    </p>
                </label>

                <img id="cover-preview" src="#" alt="Preview Cover" class="hidden w-full h-full object-cover">
                <input type="file" name="cover" id="cover" placeholder="Cover Buku" class="hidden" accept="image/*"
                    onchange="previewImage(event)">

            </div>
            <button type="submit"
                class="bg-[#F1E8FD] rounded-xl p-3 mt-2 font-bold hover:bg-[#E0D3F1] cursor-pointer">Tambah Buku</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('cover-preview');
            console.log(preview)
            const placeholder = document.getElementById('upload-placeholder');

            if (input.files && input.files[0]) {
                // Membuat URL sementara dari file yang dipilih
                const imageUrl = URL.createObjectURL(input.files[0]);

                // Pasang URL ke atribut src elemen <img>
                preview.src = imageUrl;

                // Tampilkan gambar preview dan sembunyikan placeholder tulisan
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
        }
    </script>
@endsection
