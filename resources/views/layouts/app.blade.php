    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>SiPustaka - @yield('title')</title>
    </head>

    <body class="bg-[#ECEFF5]">
        <!-- Backdrop Overlay Gelap saat Sidebar Terbuka (Khusus Mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden md:hidden transition-opacity duration-300">
        </div>

        {{-- Mobile Navbar --}}
        <div class="mobile-navbar w-full bg-white px-6 py-3 shadow-lg md:hidden block">
            <div class="flex items-center gap-2">
                <button class="show-sidebar-btn cursor-pointer hover:bg-[#F1E8FD] p-2 rounded-lg transition">
                    <i data-feather="menu" class="w-5 h-5"></i>
                </button>
                <a class="cursor-pointer" href="/buku">
                    <h2 class="font-bold text-2xl ">SiPustaka</h2>
                </a>
            </div>
        </div>

        <div class="min-h-screen w-full flex">
            {{-- Sidebar --}}
            <aside
                class="sidebar fixed top-0 left-0 max-w-[16rem] h-screen w-64 bg-white p-4 z-30 -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
                <div class="flex items-center gap-2">
                    <button
                        class="hide-sidebar-btn cursor-pointer hover:bg-[#F1E8FD] p-2 rounded-lg transition md:hidden block">
                        <i data-feather="menu" class="w-5 h-5"></i>
                    </button>
                    <a class="cursor-pointer" href="/buku">
                        <h2 class="font-bold md:text-3xl text-2xl ">SiPustaka</h2>
                    </a>
                </div>
                <ul class="flex flex-col gap-6 mt-8 ">
                    <li>
                        <a href="/buku"
                            class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2  rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold {{ request()->is('buku') ? 'bg-[#F1E8FD] text-purple-500 font-semibold shadow-lg' : '' }}">
                            <i data-feather="book-open"></i>
                            <span>Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="/anggota"
                            class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2  rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold {{ request()->is('anggota') ? 'bg-[#F1E8FD] text-purple-500 font-semibold shadow-lg' : '' }}">
                            <i data-feather="users"></i>
                            <span>Anggota</span>
                        </a>
                    </li>
                    <li>
                        <a href="/peminjaman"
                            class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2  rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold {{ request()->is('peminjaman') ? 'bg-[#F1E8FD] text-purple-500 font-semibold shadow-lg' : '' }}">
                            <i data-feather="refresh-ccw"></i>
                            <span>Peminjaman</span>
                        </a>
                    </li>
                </ul>
                <div class="absolute bottom-0 left-0 w-full p-4 flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-purple-200 rounded-full flex justify-center items-center text-xl font-semibold">
                        <span>AD</span>
                    </div>
                    <div>
                        <p class="text-center font-semibold text-lg">Admin</p>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="text-red-500  hover:underline">Keluar</a>
                        <form id="logout-form" action="/logout" method="POST" class="hidden">
                            @csrf

                        </form>
                    </div>
                </div>
            </aside>

            <main class="md:ml-72 md:mr-12 flex-1 p-6">
                @yield('content')
            </main>
        </div>

        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            const sidebar = document.querySelector(".sidebar");
            const showSidebarBtn = document.querySelector(".show-sidebar-btn");
            const hideSidebarBtn = document.querySelector(".hide-sidebar-btn");
            const sidebarOverlay = document.getElementById("sidebar-overlay");

            // Fungsi Buka Sidebar (Mobile)
            showSidebarBtn.addEventListener("click", () => {
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.add("translate-x-0");
                sidebarOverlay.classList.remove("hidden");
            });

            // Fungsi Tutup Sidebar (Mobile)
            function closeSidebar() {
                sidebar.classList.remove("translate-x-0");
                sidebar.classList.add("-translate-x-full");
                sidebarOverlay.classList.add("hidden");
            }

            hideSidebarBtn.addEventListener("click", closeSidebar);
            sidebarOverlay.addEventListener("click", closeSidebar);

            feather.replace();
        </script>
    </body>

    </html>
