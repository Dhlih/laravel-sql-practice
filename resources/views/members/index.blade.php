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
                    <tr class="hover:bg-purple-50/40 transition duration-150">
                        <td class="py-4 px-6 font-medium text-gray-900">1</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">M001</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">Yusuf Fadhlih</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">08123456789</td>
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
                </tbody>
            </table>
        </div>
    </div>

    <a href="/buku/tambah"
        class="bg-[#E5D5FC] rounded-full p-3 font-semibold shadow-lg hover:bg-[#F1E8FD] transition cursor-pointer absolute bottom-10 right-10">
        <i data-feather="plus" class="w-8 h-8"></i>
    </a>
@endsection
