<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
    <style>
        .login_img_section {
            background: linear-gradient(rgba(1, 1, 1, .5), rgba(0, 0, 0, .5)), url('/images/bg-masuk.png');
            background-size: cover;
            background-position: center;
            ;
        }
    </style>
</head>

<body>

    <div class="grid grid-cols-1 md:grid-cols-5 min-h-screen">
        <div class="col-span-2 login_img_section hidden md:flex items-center justify-center">
            <div class="relative h-screen flex flex-col items-center justify-center pt-1 mx-auto w-full">
                <div class="absolute top-4 left-5 flex items-center gap-3 text-white">
                    <img class="w-10" src="{{ asset('icons/logo.png') }}" alt="">
                    <div class="flex flex-col">
                        <span class="font-semibold text-[24px]">Perpustakaan</span>
                        <span class="text-[16px] -mt-2">Saya</span>
                    </div>
                </div>
                <h1 class="text-white text-4xl text-center font-semibold">Masuk Akun</h1>
                <p class="text-white mt-1 text-center">
                    Silahkan Masuk Akun
                </p>
                <div class="flex justify-center mt-6">
                    <a href="/login"
                        class="px-8 py-4 w-52 border-2 border-white text-white font-bold rounded-full bg-transparent hover:bg-white/20 hover:-translate-y-1 transition-all duration-500  text-center">
                        Masuk
                    </a>
                </div>
            </div>


        </div>
        <div class="col-span-3 flex justify-center items-center bg-white ">
            <div class="w-10/12 px-8 md:w-full lg:w-10/12">
                <div class="w-full">
                    <div class="mb-6">
                        <h1 class="text-[#35094D] font-semibold text-2xl text-center">Buat Akunmu Sekarang</h1>
                        <h1 class="text-[#35094D] font-semibold text-2xl text-center">Selamat Membuat!</h1>
                    </div>
                    <form id="register_form" class="" action="/daftar" method="POST">
                        @csrf
                        <label for="username" class="font-semibold text-[#35094D]">Username*</label>
                        @error('username')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <div class="flex items-center border-2 border-gray-200 mt-2 mb-4 py-2 px-3">
                            <input id="username" class=" pl-2 w-full outline-none border-none" type="text"
                                name="username" placeholder="Username" required autofocus
                                value="{{ old('username') }}" />
                        </div>
                        <label for="email" class="font-semibold text-[#35094D]">Email*</label>
                        @error('email')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <div class="flex items-center border-2 border-gray-200 mt-2 mb-4 py-2 px-3">
                            <input id="email" class=" pl-2 w-full outline-none border-none" type="text" name="email"
                                placeholder="Email" required autofocus value="{{ old('email') }}" />
                        </div>
                        <label for="no_telepon" class="font-semibold text-[#35094D]">No.telp*</label>
                        @error('no_telepon')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <div class="flex items-center border-2 border-gray-200 mt-2 mb-4 py-2 px-3">
                            <input id="no_telepon" class=" pl-2 w-full outline-none border-none" type="text"
                                name="no_telepon" placeholder="No telp" required autofocus
                                value="{{ old('no_telepon') }}" />
                        </div>
                        <label for="password" class="font-semibold text-[#35094D]">Password*</label>
                        @error('password')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <div class="flex items-center border-2 border-gray-200 py-2 mt-2 px-3 mb-3 relative">

                            <input class="pl-2 w-full outline-none border-none pr-10" name="password" type="password"
                                id="password" placeholder="Password" required />

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 text-gray-500 focus:outline-none">
                                <!-- Eye Open -->
                                <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                    c4.477 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.065 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <!-- Eye Closed -->
                                <svg id="eye-close" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                    c-4.478 0-8.268-2.943-9.543-7
                                    a9.956 9.956 0 012.223-3.592M6.18 6.18
                                    A9.956 9.956 0 0112 5
                                    c4.478 0 8.268 2.943 9.543 7
                                    a9.96 9.96 0 01-4.043 4.568M6.18 6.18L4 4
                                    m2.18 2.18l11.64 11.64" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" id="register_btn"
                                class="w-full cursor-pointer bg-[#35094D] mt-5 py-4 rounded-full hover:bg-[#35094D] hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2">
                                <span id="text-register">DAFTAR</span>
                            </button>
                        </div>
                        <div class="flex justify-center mt-4">
                            <span class="">Sudah Punya Akun? <a href="/login" class="text-[#35094D] font-semibold">Masuk
                                    Sekarang</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JS toogle eye password
        function togglePassword() {
            const password = document.getElementById("password");
            const eyeOpen = document.getElementById("eye-open");
            const eyeClose = document.getElementById("eye-close");

            if (password.type === "password") {
                password.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClose.classList.remove("hidden");
            } else {
                password.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClose.classList.add("hidden");
            }
        }

        // JS loading Daftar
        const register_form = document.getElementById("register_form");
        const register_btn = document.getElementById("register_btn");
        const text_register = document.getElementById('text-register');

        register_form.addEventListener('submit', function () {
            // Nonaktifkan tombol
            register_btn.disabled = true;
            register_btn.classList.add('opacity-70', 'cursor-not-allowed');

            // Ubah teks
            text_register.innerText = 'Tunggu...';
        });

    </script>

</body>

</html>