<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title inertia>Aplikasi Aulia</title>

    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @inertiaHead
</head>

<body class="bg-gray-100">

<nav class="bg-white p-4 rounded shadow mb-6">
    <a href="{{ url('propinsi') }}"
    class="text-blue-600 font-bold mr-4 hover:underline">Propinsi</a>

    <a href="{{ url('kabkota') }}"
    class="text-blue-600 font-bold hover:underline">Kab/Kota</a>
</nav>
    
<div class="container mx-auto px-4">
    @inertia
</div>

</body>
</html>