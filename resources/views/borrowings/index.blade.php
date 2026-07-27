@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="w-full flex items-center justify-between mb-10">
        <h1 class="text-4xl font-bold text-gray-800">Peminjaman Buku</h1>

        <form action="/anggota" method="GET" class="max-w-xs w-full flex items-center gap-4 ">
            <input type="text" name="judul" placeholder="Ketik judul buku..."
                class="w-full bg-white p-2 rounded-lg outline-none shadow-lg" value="{{ request('judul') }}">

            <button type="submit"
                class="bg-[#F1E8FD] p-2 px-4 rounded-lg font-semibold shadow-lg hover:bg-[#E5D5FC] transition cursor-pointer">
                <i data-feather="search"></i>
            </button>
        </form>
    </div>

    <!-- Kontainer Pembungkus Tabel -->
    <div class="w-full  bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div>
            <table class="w-full text-left border-collapse">
                <!-- Header Tabel -->
                <thead>
                    <tr class="bg-[#F9F5FF] border-b border-gray-200 text-gray-600 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6 font-semibold">No</th>
                        <th class="py-4 px-6 font-semibold">Judul Buku</th>
                        <th class="py-4 px-6 font-semibold">Peminjam</th>
                        <th class="py-4 px-6 font-semibold">Tanggal Pinjam</th>
                        <th class="py-4 px-6 font-semibold">Tanggal Kembali</th>
                        <th class="py-4 px-9 font-semibold">Status</th>
                    </tr>
                </thead>

                <!-- Isi Tabel -->
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse ($borrowings as $borrowing)
                        <tr class="hover:bg-purple-50/40 transition duration-150">
                            <td class="py-4 px-6 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $borrowing->judul_buku }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $borrowing->nama_peminjam }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $borrowing->tanggal_pinjam }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">{{ $borrowing->tanggal_kembali_seharusnya }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800  ">
                                <span class="rounded-full px-3 py-1 shadow-lg {{ $borrowing->status == 'kembali' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $borrowing->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 px-6 text-center text-gray-500">Tidak ada data peminjaman</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <button
        class="add-member-btn bg-[#E5D5FC] rounded-full p-3 font-semibold shadow-lg hover:bg-[#F1E8FD] transition cursor-pointer absolute bottom-10 right-10">
        <i data-feather="plus" class="w-8 h-8"></i>
    </button>

    <!-- Modal Backdrop -->
    <div class="backdrop fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <!-- Kotak Modal Menambahkan Anggota -->
        <div class="add-member-modal max-w-sm w-full rounded-xl hidden bg-white shadow-2xl p-6 relative">
            <form action="/anggota" method="POST" class="flex flex-col gap-4">
                <h3 class="text-xl font-bold text-gray-800 ">Tambah Anggota</h3>
                <input type="text" name="nama" placeholder="Ketik nama anggota..."
                    class="w-full border border-gray-200 p-2 rounded-lg outline-none">
                <input type="number" name="telepon" placeholder="Ketik telepon anggota..."
                    class="w-full border border-gray-200 p-2 rounded-lg outline-none">
                <button
                    class="bg-[#E5D5FC] p-2 rounded-lg font-semibold shadow-lg mt-2 hover:bg-[#F1E8FD] transition cursor-pointer">Tambah
                    anggota</button>
            </form>

            <div class="absolute top-3 right-3">
                <button class="close-add-popup-btn text-gray-500 hover:text-gray-700 transition cursor-pointer"
                    title="Tutup">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <!-- Kotak Modal Mengedit Anggota -->
        <div class="edit-member-modal max-w-sm w-full rounded-xl hidden bg-white shadow-2xl p-6 relative">
            <form id="edit-form" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PUT')
                <h3 class="text-xl font-bold text-gray-800 ">Edit Anggota</h3>
                <input type="text" name="nama" id="edit-nama" placeholder="Ketik nama anggota..."
                    class="w-full border border-gray-200 p-2 rounded-lg outline-none">
                <input type="number" name="telepon" id="edit-telepon" placeholder="Ketik telepon anggota..."
                    class="w-full border border-gray-200 p-2 rounded-lg outline-none">
                <button
                    class="bg-[#E5D5FC] p-2 rounded-lg font-semibold shadow-lg mt-2 hover:bg-[#F1E8FD] transition cursor-pointer">Edit
                    anggota</button>
            </form>

            <div class="absolute top-3 right-3">
                <button class="close-edit-popup-btn text-gray-500 hover:text-gray-700 transition cursor-pointer"
                    title="Tutup">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        const backdrop = document.querySelector(".backdrop");

        // Tambah Anggota
        const addMemberBtn = document.querySelector(".add-member-btn");
        const addMemberPoUp = document.querySelector(".add-member-modal");
        const closeAddPopupBtn = document.querySelector(".close-add-popup-btn");

        addMemberBtn.addEventListener("click", showPopUp = () => {
            backdrop.classList.remove("hidden");
            backdrop.classList.add("flex");
            addMemberPoUp.classList.remove("hidden");
        })

        closeAddPopupBtn.addEventListener("click", hideAddMemberPopUp = () => {
            backdrop.classList.remove("flex");
            backdrop.classList.add("hidden");
            addMemberPoUp.classList.add("hidden");
        })

        // Edit Anggota
        const editMemberPoUp = document.querySelector(".edit-member-modal");
        const editMemberBtns = document.querySelectorAll(".edit-member-btn");
        const closeEditPopupBtn = document.querySelector(".close-edit-popup-btn");

        const editForm = document.querySelector("#edit-form");
        const editNamaInput = document.querySelector("#edit-nama");
        const editTeleponInput = document.querySelector("#edit-telepon");

        // Loop seluruh tombol edit di setiap baris tabel
        editMemberBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                // Ambil data dari data-id, data-nama, data-telepon
                const id = btn.dataset.id;
                const nama = btn.dataset.nama;
                const telepon = btn.dataset.telepon;

                // Set action form dan value input modal
                editForm.action = `/anggota/${id}`;
                editNamaInput.value = nama;
                editTeleponInput.value = telepon;

                // Tampilkan modal
                backdrop.classList.remove("hidden");
                backdrop.classList.add("flex");
                editMemberPoUp.classList.remove("hidden");
            });
        });

        closeEditPopupBtn.addEventListener("click", hideEditMemberPopUp = () => {
            backdrop.classList.remove("flex");
            backdrop.classList.add("hidden");
            editMemberPoUp.classList.add("hidden");
        })
    </script>
@endsection