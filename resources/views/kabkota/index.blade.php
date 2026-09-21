<!DOCTYPE html>
<html>
<head>
    <title>Data Kabupaten/Kota</title>
</head>
<body>
    
    @extends('layouts.app')
    @section('title', 'Daftar Kabupaten/Kota')
    @section('page-title', 'Daftar Kabupaten/Kota')
    @section('page-subtitle', 'Kelola data kabupaten/kota di sini')
    @section('create-url', '/kabkota/create')
    @section('create-label', 'Tambah Kab/Kota')
    @section('content')

    <!-- FILTER CARD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-5">
        <form action="/kabkota" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <input type="text" name="id_kabkota" placeholder="ID KabKota" value="{{ request('id_kabkota') }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                <input type="text" name="kabupatenkota" placeholder="Kabupaten/Kota" value="{{ request('kabupatenkota') }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                <input type="text" name="id_propinsi" placeholder="ID Propinsi" value="{{ request('id_propinsi') }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div class="mt-4 flex gap-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Filter
                </button>
                <a href="/kabkota"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    @php
        $sortUrl = fn($col) => request()->fullUrlWithQuery([
            'sort' => $col,
            'order' => request('sort') == $col && request('order') == 'asc' ? 'desc' : 'asc'
        ]);
        $sortIcon = fn($col) => request('sort') == $col ? (request('order') == 'asc' ? ' ▲' : ' ▼') : '';
    @endphp

    <!-- TABEL CARD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left border-b border-gray-100">
                <tr>
                    <th class="px-5 py-3 font-medium">
                        <a href="{{ $sortUrl('IdKabKota') }}" class="hover:text-blue-600 flex items-center gap-1">
                            ID KabKota{{ $sortIcon('IdKabKota') }}
                        </a>
                    </th>
                    <th class="px-5 py-3 font-medium">
                        <a href="{{ $sortUrl('KabupatenKota') }}" class="hover:text-blue-600 flex items-center gap-1">
                            Nama Kabupaten/Kota{{ $sortIcon('KabupatenKota') }}
                        </a>
                    </th>
                    <th class="px-5 py-3 font-medium">
                        <a href="{{ $sortUrl('IdPropinsi') }}" class="hover:text-blue-600 flex items-center gap-1">
                            ID Propinsi{{ $sortIcon('IdPropinsi') }}
                        </a>
                    </th>
                    <th class="px-5 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($data as $item)
                <tr class="hover:bg-blue-50/50 transition">
                    <td class="px-5 py-3 text-gray-600">{{ $item->IdKabKota }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $item->KabupatenKota }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $item->IdPropinsi }}</td>
                    <td class="px-5 py-3 text-right space-x-2">
                        <a href="/kabkota/{{ $item->IdKabKota }}/edit"
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                        <form action="/kabkota/{{ $item->IdKabKota }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="flex justify-between items-center mt-5 text-sm">
        <span class="text-gray-500">
            Menampilkan {{ $data->count() }} dari {{ $data->total() }} data
        </span>
        <div class="flex items-center gap-1">
            @if($data->onFirstPage())
                <span class="px-3 py-1 text-gray-300 rounded-lg">‹ Prev</span>
            @else
                <a href="{{ $data->previousPageUrl() }}"
                   class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-lg transition">‹ Prev</a>
            @endif

            @for($i = 1; $i <= $data->lastPage(); $i++)
                @if($i == $data->currentPage())
                    <span class="px-3 py-1 bg-blue-600 text-white rounded-lg font-medium">{{ $i }}</span>
                @else
                    <a href="{{ $data->url($i) }}"
                       class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-lg transition">{{ $i }}</a>
                @endif
            @endfor

            @if($data->hasMorePages())
                <a href="{{ $data->nextPageUrl() }}"
                   class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-lg transition">Next ›</a>
            @else
                <span class="px-3 py-1 text-gray-300 rounded-lg">Next ›</span>
            @endif
        </div>
    </div>

    @endsection

</body>
</html>