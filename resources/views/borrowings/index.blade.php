@extends('layouts.app')

@section('title', 'Peminjaman Buku')

@section('content')
    <div class="max-w-5xl w-full md:flex items-center justify-between mb-10">
        <h1 class="md:text-4xl text-3xl font-bold text-gray-800">Peminjaman Buku</h1>

        <!-- Form Pencarian Tabel Peminjaman -->
        <form action="/peminjaman" method="GET" class="md:max-w-xs w-full flex items-center gap-4 md:mt-0 mt-4">
            <input type="text" name="judul" placeholder="Ketik judul buku..."
                class="w-full bg-white p-2 rounded-lg outline-none shadow-lg" value="{{ request('judul') }}">

            <button type="submit"
                class="bg-[#F1E8FD] p-2 px-4 rounded-lg font-semibold shadow-lg hover:bg-[#E5D5FC] transition cursor-pointer">
                <i data-feather="search"></i>
            </button>
        </form>
    </div>

    <!-- Kontainer Pembungkus Tabel -->
    <div class="max-w-5xl w-full bg-white rounded-xl shadow-lg overflow-x-auto border border-gray-100">
        <table class="w-full min-w-[700px] text-left border-collapse whitespace-nowrap">
            <!-- Header Tabel -->
            <thead>
                <tr class="bg-[#F9F5FF] border-b border-gray-200 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="py-4 px-6 font-semibold">No</th>
                    <th class="py-4 px-6 font-semibold">Judul Buku</th>
                    <th class="py-4 px-6 font-semibold">Peminjam</th>
                    <th class="py-4 px-6 font-semibold">Tanggal Pinjam</th>
                    <th class="py-4 px-6 font-semibold">Tanggal Kembali</th>
                    <th class="py-4 px-9 font-semibold">Status</th>
                    <th class="py-4 px-9 font-semibold">Aksi</th>
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
                        <td class="py-4 px-6 font-semibold text-gray-800">
                            {{ $borrowing->tanggal_kembali_seharusnya }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">
                            <span
                                class="rounded-lg px-3 py-1 shadow-lg {{ $borrowing->status == 'kembali' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $borrowing->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <a href="/peminjaman/{{ $borrowing->id }}"
                                class="bg-[#F1E8FD] hover:bg-[#E5D5FC] text-purple-800 shadow-lg p-2 px-3 rounded-lg font-semibold text-xs transition inline-flex items-center gap-1">
                                <i data-feather="eye" class="w-4 h-4"></i>
                                <span>Detail</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-6 text-center text-gray-500">Tidak ada data peminjaman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol Floating Tambah Peminjaman -->
    <button
        class="add-member-btn bg-[#E5D5FC] rounded-full p-3 font-semibold shadow-lg hover:bg-[#F1E8FD] transition cursor-pointer fixed bottom-10 right-10 z-40">
        <i data-feather="plus" class="w-8 h-8"></i>
    </button>

    <!-- Modal Backdrop -->
    <div class="backdrop fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
        <!-- Kotak Modal Menambahkan Peminjaman -->
        <div class="add-member-modal lg:max-w-sm max-w-md w-full rounded-xl hidden bg-white shadow-2xl p-6 relative">
            <form action="/peminjaman" method="POST" class="flex flex-col gap-4">
                @csrf
                <h3 class="text-xl font-bold text-gray-800">Tambah Peminjaman</h3>

                <!-- Input Live Search Anggota -->
                <div class="relative flex flex-col gap-1">
                    <label for="search-member" class="text-xs font-semibold text-gray-600">Nama Anggota</label>
                    <input type="text" id="search-member" placeholder="Ketik nama anggota..." autocomplete="off" required
                        class="w-full border border-gray-200 p-2 rounded-lg outline-none text-gray-700">

                    <input type="hidden" name="id_member" id="id-member" required>

                    <div id="dropdown-member"
                        class="hidden absolute top-full left-0 w-full bg-white border border-gray-200 rounded-lg shadow-xl z-20 max-h-48 overflow-y-auto mt-1 divide-y divide-gray-100">
                    </div>
                </div>

                <!-- Input Live Search Buku -->
                <div class="relative flex flex-col gap-1">
                    <label for="search-book" class="text-xs font-semibold text-gray-600">Judul Buku</label>
                    <input type="text" id="search-book" placeholder="Ketik judul buku..." autocomplete="off" required
                        class="w-full border border-gray-200 p-2 rounded-lg outline-none text-gray-700">

                    <input type="hidden" name="id_buku" id="id-book" required>

                    <div id="dropdown-book"
                        class="hidden absolute top-full left-0 w-full bg-white border border-gray-200 rounded-lg shadow-xl z-20 max-h-48 overflow-y-auto mt-1 divide-y divide-gray-100">
                    </div>
                </div>

                <!-- Input Tanggal Pinjam -->
                <div class="flex flex-col gap-1">
                    <label for="tanggal_pinjam" class="text-xs font-semibold text-gray-600">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required
                        class="w-full border border-gray-200 p-2 rounded-lg outline-none text-gray-700">
                </div>

                <!-- Input Tenggat Kembali -->
                <div class="flex flex-col gap-1">
                    <label for="tenggat_kembali" class="text-xs font-semibold text-gray-600">Tenggat Kembali</label>
                    <input type="date" name="tenggat_kembali" id="tenggat_kembali" required
                        class="w-full border border-gray-200 p-2 rounded-lg outline-none text-gray-700">
                </div>

                <button type="submit"
                    class="bg-[#E5D5FC] p-2 rounded-lg font-semibold shadow-lg mt-2 hover:bg-[#F1E8FD] transition cursor-pointer">
                    Tambah peminjaman
                </button>
            </form>

            <div class="absolute top-3 right-3">
                <button class="close-add-popup-btn text-gray-500 hover:text-gray-700 transition cursor-pointer"
                    title="Tutup">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Modal Control
        const backdrop = document.querySelector(".backdrop");
        const addMemberBtn = document.querySelector(".add-member-btn");
        const addMemberPopUp = document.querySelector(".add-member-modal");
        const closeAddPopupBtn = document.querySelector(".close-add-popup-btn");

        addMemberBtn.addEventListener("click", () => {
            backdrop.classList.remove("hidden");
            backdrop.classList.add("flex");
            addMemberPopUp.classList.remove("hidden");
        });

        closeAddPopupBtn.addEventListener("click", () => {
            backdrop.classList.remove("flex");
            backdrop.classList.add("hidden");
            addMemberPopUp.classList.add("hidden");
        });

        // Live Search Reusable Function dengan Debounce
        function setupLiveSearch(inputId, hiddenId, dropdownId, endpointUrl, displayKey) {
            const inputEl = document.getElementById(inputId);
            const hiddenEl = document.getElementById(hiddenId);
            const dropdownEl = document.getElementById(dropdownId);

            let debounceTimer;

            inputEl.addEventListener('input', function() {
                const query = this.value.trim();

                clearTimeout(debounceTimer);
                hiddenEl.value = '';

                if (query.length < 2) {
                    dropdownEl.innerHTML = '';
                    dropdownEl.classList.add('hidden');
                    return;
                }

                debounceTimer = setTimeout(async () => {
                    try {
                        const response = await fetch(`${endpointUrl}?q=${encodeURIComponent(query)}`);
                        const data = await response.json();
                        console.log(data)

                        if (data.length === 0) {
                            dropdownEl.innerHTML =
                                '<div class="p-3 text-xs text-gray-400">Data tidak ditemukan</div>';
                        } else {
                            dropdownEl.innerHTML = data.map(item => `
                                <div class="p-2.5 hover:bg-purple-50 cursor-pointer text-sm text-gray-700 transition"
                                     data-id="${item.id}" data-label="${item[displayKey]}">
                                    ${item[displayKey]}
                                </div>
                            `).join('');

                            dropdownEl.querySelectorAll('div[data-id]').forEach(element => {
                                element.addEventListener('click', function() {
                                    inputEl.value = this.dataset.label;
                                    hiddenEl.value = this.dataset.id;
                                    dropdownEl.classList.add('hidden');
                                });
                            });
                        }

                        dropdownEl.classList.remove('hidden');
                    } catch (error) {
                        console.error('Gagal mengambil data:', error);
                    }
                }, 300);
            });

            // Sembunyikan dropdown saat klik di luar elemen
            document.addEventListener('click', function(e) {
                if (!inputEl.contains(e.target) && !dropdownEl.contains(e.target)) {
                    dropdownEl.classList.add('hidden');
                }
            });
        }

        // Inisialisasi Live Search Anggota dan Buku
        setupLiveSearch('search-member', 'id-member', 'dropdown-member', '/api/anggota/search', 'nama');
        setupLiveSearch('search-book', 'id-book', 'dropdown-book', '/api/buku/search', 'judul');
    </script>
@endsection
