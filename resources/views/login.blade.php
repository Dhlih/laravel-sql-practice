<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login SiPustaka</title>
</head>

<body>
    <div class="container h-screen flex items-center justify-center bg-[#ECEFF5]">
        <div class="max-w-sm w-full">
            <h1 class="text-center font-bold text-3xl">Login SiPustaka</h1>
            <div class="rounded-xl p-6 mt-8 bg-white shadow-lg">
                <form action="/login" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="email" class="font-semibold">Email</label>
                        <input type="text" name="email" placeholder="Masukkan email..."
                            class="bg-[#ECEFF5] p-2 rounded-lg outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="password" class="font-semibold">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password..."
                            class="bg-[#ECEFF5] p-2 rounded-lg outline-none">
                    </div>
                    <button type="submit" class="bg-[#F1E8FD] rounded-xl p-3 mt-2 font-semibold">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
