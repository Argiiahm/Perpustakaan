<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan saya</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-[#F8F8F8]">

    {{-- Sidebar --}}
    <div class="fixed z-40">
        @include('components.sidebar')
    </div>

    {{-- Main Content --}}
    <main class="ml-80 min-h-screen p-6">
        @yield('main')
    </main>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>