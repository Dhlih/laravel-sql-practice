@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-4xl font-bold text-gray-800">Anggota</h1>

        <form action="/anggota" method="GET" class="max-w-xs w-full flex items-center gap-4 ">
            <input type="text" name="nama" placeholder="Ketik nama anggota..."
                class="w-full bg-white p-2 rounded-lg outline-none shadow-lg" value="{{ request('nama') }}">

            <button type="submit"
                class="bg-[#F1E8FD] p-2 px-4 rounded-lg font-semibold shadow-lg hover:bg-[#E5D5FC] transition cursor-pointer">
                <i data-feather="search"></i>
            </button>
        </form>
    </div>

    <!-- Kontainer Pembungkus Tabel -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div>
            <table class="w-full text-left border-collapse">
                <!-- Header Tabel -->
                <thead>
                    <tr class="bg-[#F9F5FF] border-b border-gray-200 text-gray-600 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6 font-semibold">No</th>
                        <th class="py-4 px-6 font-semibold">Kode Member</th>
                        <th class="py-4 px-6 font-semibold">Nama Anggota</th>
                        <th class="py-4 px-6 font-semibold">Telepon</th>
                        <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- Isi Tabel -->
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    {{-- Contoh Baris Data (Nanti diganti dengan @foreach ($members as $index => $member)) --}}
                    @foreach ($members as $member) 
                    <tr class="hover:bg-purple-50/40 transition duration-150">
                        <td class="py-4 px-6 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">{{ $member->kode_member }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">{{ $member->nama }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">{{ $member->telepon }}</td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="/anggota/1/edit" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                    title="Edit">
                                    <i data-feather="edit-2" class="w-4 h-4"></i>
                                </a>
                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition cursor-pointer"
                                    title="Hapus">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
        <!-- Kotak Modal -->
        <div class="modal max-w-sm w-full rounded-xl bg-white shadow-2xl p-6 relative">
            <form action="/anggota" method="POST" class="flex flex-col gap-4">
                <h3 class="text-xl font-bold text-gray-800 ">Tambah Anggota</h3>
                <input type="text" name="nama" placeholder="Ketik nama anggota..."
                    class="w-full border border-gray-200 p-2 rounded-lg outline-none">
                <input type="text" name="telepon" placeholder="Ketik telepon anggota..."
                    class="w-full border border-gray-200 p-2 rounded-lg outline-none">
                <button
                    class="bg-[#E5D5FC] p-2 rounded-lg font-semibold shadow-lg mt-2 hover:bg-[#F1E8FD] transition cursor-pointer">Tambah
                    anggota</button>
            </form>

            <div class="absolute top-3 right-3">
                <button class="close-popup-btn text-gray-500 hover:text-gray-700 transition cursor-pointer" title="Tutup">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>

            </div>

        </div>
    </div>

    <script>
        const addMemberBtn = document.querySelector(".add-member-btn");
        const backdrop = document.querySelector(".backdrop");
        addMemberBtn.addEventListener("click", showPopUp = () => {
            backdrop.classList.remove("hidden");
            backdrop.classList.add("flex");
        })

        const closePopupBtn = document.querySelector(".close-popup-btn");
        closePopupBtn.addEventListener("click", hidePopUp = () => {
            backdrop.classList.remove("flex");
            backdrop.classList.add("hidden");
        })
    </script>
@endsection
