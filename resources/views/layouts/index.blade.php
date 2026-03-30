<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#F8F8F8]">

    {{-- Sidebar --}}
    <div class="fixed z-40">
        @include('components.sidebar')
    </div>

    {{-- Main Content --}}
    <main class="ml-80 min-h-screen p-6">
        {{-- Header --}}
        @auth
            @php
                $role = Auth::user()->role;
                if ($role === 'kepala_perpus') {
                    $nama = Auth::user()->KepalaPerpus->nama_lengkap ?? Auth::user()->username;
                } elseif ($role === 'petugas') {
                    $nama = Auth::user()->Petugas->nama_lengkap ?? Auth::user()->username;
                } elseif ($role === 'anggota') {
                    $nama = Auth::user()->Anggota->nama_lengkap ?? Auth::user()->username;
                } else {
                    $nama = Auth::user()->username;
                }
            @endphp
            <section>
                <h1 class="text-[30px] text-[#35094D]">Hallo, <span class="font-semibold">{{ $nama }}</span></h1>
                <span class="text-[#35094d90]">Selamat Datang Kembali Di Halaman <span
                        class="font-medium text-[#35094D]">@yield('halaman')</span> @yield('suffix')</span>
            </section>
        @endauth

        @yield('main')
    </main>

    {{-- Modal alert --}}
    @include('components.alert-success')
    @include('components.alert-error')

    {{-- Loading Search --}}
    @include('components.loading-cari')

    {{-- Loading Sidebar Navigation --}}
    @include('components.loading-sidebar')

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>