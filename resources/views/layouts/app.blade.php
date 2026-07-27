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
        <div class="min-h-screen w-full flex">
            <div class="fixed top-0 left-0 max-w-[16rem] h-screen w-64 bg-white p-6 z-10">
                <a class="cursor-pointer" href="/dashboard">
                    <h2 class="font-bold text-3xl ">SiPustaka</h2>
                </a>
                <ul class="flex flex-col gap-6 mt-8 ">
                    {{-- <li>
                        <a href="/dashboard"
                            class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2  rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold {{ request()->is('dashboard') ? 'bg-[#F1E8FD] text-purple-500 font-semibold shadow-lg' : '' }}">
                            <i data-feather="bar-chart-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li> --}}
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
                <div class="absolute bottom-0 left-0 w-full p-6 flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-purple-200 rounded-full flex justify-center items-center text-xl font-semibold">
                        AD
                    </div>
                    <div>
                        <p class="text-center font-semibold text-lg">Admin</p>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="text-red-500  hover:underline">Keluar</a>
                        <form id="logout-form" action="/logout" method="POST" class="hidden">
                            @csrf

                        </form>
                    </div>
                </div>
            </div>
            <main class="ml-72 mr-12 flex-1 p-8">
                @yield('content')
            </main>
        </div>

        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            feather.replace();
        </script>
    </body>

    </html>
