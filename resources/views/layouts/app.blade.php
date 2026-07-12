<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>SiPustaka - @yield('title')</title>
</head>

<body>
    <div class="container h-screen flex bg-[#ECEFF5] gap-12">
        <div class="sidebar max-w-[16rem] w-full bg-white p-6">
            <h2 class="font-bold text-2xl">SiPustaka</h2>
            <ul class="flex flex-col gap-6 mt-8 ">
                <li
                    class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2 rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold">
                    <i data-feather="bar-chart-2"></i>
                    <a href="dashboard">Dashboard</a>
                </li>
                <li
                    class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2 rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold">
                    <i data-feather="book"></i>
                    <a href="buku">Buku</a>
                </li>
                <li
                    class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2 rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold">
                    <i data-feather="users"></i>
                    <a href="anggota">Anggota</a>
                </li>
                <li
                    class="flex items-center gap-4 hover:bg-[#F1E8FD] p-2 rounded-lg cursor-pointer hover:text-purple-500 hover:font-semibold">
                    <i data-feather="refresh-ccw"></i>
                    <a href="riwayat">Riwayat</a>
                </li>
            </ul>
            <div class="absolute bottom-0 left-0 w-full p-6 flex items-center gap-4">
                <div
                    class="w-14 h-14 bg-purple-200 rounded-full flex justify-center items-center text-xl font-semibold">
                    IY
                </div>
                <div>
                    <p class="text-center font-semibold text-lg">Iyan Yudistira</p>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="text-red-500  hover:underline">Keluar</a>
                    <form id="logout-form" action="/logout" method="POST" class="hidden">
                        @csrf

                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-full w-full p-6">
            @yield('content')
        </div>
    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>
