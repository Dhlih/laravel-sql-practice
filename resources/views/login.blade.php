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
        <div class="max-w-xs w-full">
            <h1 class="text-center font-bold text-3xl">Login SiPustaka</h1>
            {{-- card --}}
            <div class="rounded-xl p-6 mt-8 bg-white shadow-lg">
                <form action="/login" method="POST" class="flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="email" class="font-semibold">Email</label>
                        <input type="text" name="email" placeholder="Masukkan email..."
                            class="bg-[#ECEFF5] p-2 rounded-lg outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="password" class="font-semibold">Password</label>
                        <div
                            class="w-full flex items-center justify-between bg-[#ECEFF5] p-2 rounded-lg outline-none gap-4">
                            <input type="password" name="password" placeholder="Masukkan password..."
                                class="password-input w-full outline-none">
                            <button type="button"
                                class="toggle-password-btn flex items-center justify-center cursor-pointer text-gray-500 hover:text-gray-700">
                                <i data-feather="eye-off" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                    @if (session('error'))
                        <span class="text-red-500">*{{ session('error') }}</span>
                    @endif
                    <button type="submit"
                        class="bg-[#F1E8FD] rounded-xl p-3 mt-4 font-bold hover:bg-[#E0D3F1] cursor-pointer">
                        Login
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();

        const passwordInput = document.querySelector(".password-input");
        const togglePasswordBtn = document.querySelector(".toggle-password-btn");

        togglePasswordBtn.addEventListener("click", () => {
            const eyeIcon = togglePasswordBtn.querySelector("svg");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.setAttribute("data-feather", "eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.setAttribute("data-feather", "eye-off");
            }

            feather.replace();
        });
    </script>
</body>

</html>
