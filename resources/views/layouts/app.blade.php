<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Propinsi')</title>

    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 p-6">

    <!-- NAVIGASI -->
    <nav class="bg-white p-4 rounded shadow mb-6">
        <a href="/propinsi" class="text-blue-600 font-bold mr-4 hover:underline">Propinsi</a>
        <a href="/kabkota" class="text-blue-600 font-bold hover:underline">Kab/Kota</a>
    </nav>

    <!-- KONTEN -->
    @yield('content')

</body>
</html>