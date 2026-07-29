@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <!-- Top Navigation & Status Bar Utama -->
    <div class="max-w-5xl w-full flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="/peminjaman"
                class="w-10 h-10 bg-white hover:bg-[#F1E8FD] text-gray-700 hover:text-purple-700 rounded-xl shadow-md flex items-center justify-center transition-all duration-200 cursor-pointer">
                <i data-feather="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="md:text-4xl text-3xl font-extrabold text-gray-800 tracking-tight">Detail Peminjaman</h1>
            </div>
        </div>

        <!-- Dynamic Status Badge dengan Live Dot Indicator -->
        <div
            class="flex items-center gap-2.5 px-4 py-2 rounded-xl text-sm font-bold shadow-sm border {{ $borrowing->status == 'kembali' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
            <span
                class="w-2.5 h-2.5 rounded-full {{ $borrowing->status == 'kembali' ? 'bg-emerald-500' : 'bg-rose-500 animate-pulse' }}"></span>
            <span>{{ $borrowing->status == 'kembali' ? 'Sudah Dikembalikan' : 'Sedang Dipinjam' }}</span>
        </div>
    </div>

    <!-- Layout Asimetris (Grid 12 Kolom) -->
    <div class="max-w-5xl w-full grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Kiri: Card Visual Buku (4 Kolom) -->
        <div class="lg:col-span-4 bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center border border-gray-100/80">
            <div
                class="relative w-full aspect-[3/4] mb-5 rounded-xl overflow-hidden shadow-md bg-[#ECEFF5] flex items-center justify-center group">
                @if ($borrowing->cover)
                    <img src="{{ asset('storage/' . $borrowing->cover) }}" alt="{{ $borrowing->judul_buku }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="flex flex-col items-center gap-2 text-gray-400">
                        <i data-feather="book-open" class="w-12 h-12"></i>
                        <span class="text-xs font-medium">Cover tidak tersedia</span>
                    </div>
                @endif
            </div>

            <div class="w-full text-center">

                <h2 class="text-lg font-bold text-gray-900 leading-snug line-clamp-2">{{ $borrowing->judul_buku }}</h2>
                <span class="text-opacity-85">{{ $borrowing->penulis }}</span>
            </div>
        </div>

        <!-- Kanan: Card Detail & Timeline (8 Kolom) -->
        <div class="lg:col-span-8 flex flex-col gap-6">

            <!-- Card 1: Informasi Anggota Peminjam -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100/80">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-lg bg-[#F1E8FD] text-purple-700 flex items-center justify-center">
                        <i data-feather="user" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-800">Informasi Peminjam</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-[#ECEFF5]/60 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs font-medium text-gray-500 mb-1">Kode Member</p>
                        <p class="text-base font-bold text-gray-900tracking-wide">{{ $borrowing->kode_member }}</p>
                    </div>
                    <div class="bg-[#ECEFF5]/60 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs font-medium text-gray-500 mb-1">Nama Anggota</p>
                        <p class="text-base font-bold text-gray-900">{{ $borrowing->nama_peminjam }}</p>
                    </div>
                    <div class="bg-[#ECEFF5]/60 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs font-medium text-gray-500 mb-1">Telepon</p>
                        <p class="text-base font-bold text-gray-900 tracking-wide">{{ $borrowing->telepon }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Timeline Jadwal Peminjaman -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100/80">
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="w-8 h-8 rounded-lg bg-[#F1E8FD] text-purple-700 flex items-center justify-center">
                        <i data-feather="calendar" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-800">Jadwal Peminjaman</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <span class="text-xs font-medium text-gray-400 block mb-1">Tanggal Pinjam</span>
                        <span class="text-sm font-bold text-gray-800 block">{{ $borrowing->tanggal_pinjam }}</span>
                    </div>


                    <div class="p-4 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <span class="text-xs font-medium text-gray-400 block mb-1">Tenggat Kembali</span>
                        <span
                            class="text-sm font-bold text-gray-800 block">{{ $borrowing->tanggal_kembali_seharusnya }}</span>

                    </div>

                    <div class="p-4 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <span class="text-xs font-medium text-gray-400 block mb-1">Dikembalikan Pada</span>
                        <span class="text-sm font-bold text-gray-800 block">
                            {{ $borrowing->tanggal_kembali_aktual ?? '-' }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- Card 3: Rincian Keuangan & Denda -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100/80 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl {{ ($borrowing->denda ?? 0) > 0 ? 'bg-rose-100 text-rose-600' : 'bg-emerald-100 text-emerald-600' }} flex items-center justify-center">
                        <i data-feather="credit-card" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-gray-800">Status Denda Transaksi</h4>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ ($borrowing->denda ?? 0) > 0 ? 'Terdapat keterlambatan pengembalian buku' : 'Bebas denda, tidak ada keterlambatan' }}
                        </p>
                    </div>
                </div>

                <div class="text-right">
                    <span class="text-xs font-medium text-gray-400 block uppercase tracking-wider">Total Denda</span>
                    <span
                        class="text-2xl font-black {{ ($borrowing->denda ?? 0) > 0 ? 'text-rose-600' : 'text-emerald-600' }}">
                        Rp {{ number_format($borrowing->denda ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>

        </div>
    </div>
@endsection
