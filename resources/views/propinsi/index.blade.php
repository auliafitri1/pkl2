@extends('layouts.app')

@section('title', 'Daftar Propinsi')
@section('page-title', 'Daftar Propinsi')
@section('page-subtitle', 'Kelola data propinsi di sini')
@section('create-url', '/propinsi/create')
@section('create-label', 'Tambah Propinsi')

@section('content')

    <!-- CARD PEMBUNGKUS -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- HEADER CARD -->
        <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <h2 class="font-semibold text-gray-800">Daftar Propinsi</h2>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
                    {{ $data->total() }} data
                </span>
            </div>
            <div class="flex gap-2 text-sm text-gray-500">
                <a href="/propinsi" class="hover:text-blue-600">Reset</a>
            </div>
        </div>

        <!-- FILTER -->
        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
            <form action="/propinsi" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <input type="text" name="id_propinsi" placeholder="ID Propinsi" value="{{ request('id_propinsi') }}"
                           class="border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="propinsi" placeholder="Nama Propinsi" value="{{ request('propinsi') }}"
                           class="border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="id_negara" placeholder="ID Negara" value="{{ request('id_negara') }}"
                           class="border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" name="sort_order" placeholder="Sort Order" value="{{ request('sort_order') }}"
                           class="border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mt-3 flex gap-2">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        Filter
                    </button>
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

        <!-- TABEL -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 bg-gray-50 border-b border-gray-100">
                        <th class="px-5 py-3 font-medium">
                            <a href="{{ $sortUrl('IdPropinsi') }}" class="hover:text-blue-600">ID Propinsi{{ $sortIcon('IdPropinsi') }}</a>
                        </th>
                        <th class="px-5 py-3 font-medium">
                            <a href="{{ $sortUrl('Propinsi') }}" class="hover:text-blue-600">Nama Propinsi{{ $sortIcon('Propinsi') }}</a>
                        </th>
                        <th class="px-5 py-3 font-medium">
                            <a href="{{ $sortUrl('IdNegara') }}" class="hover:text-blue-600">ID Negara{{ $sortIcon('IdNegara') }}</a>
                        </th>
                        <th class="px-5 py-3 font-medium">
                            <a href="{{ $sortUrl('SortOrder') }}" class="hover:text-blue-600">Sort Order{{ $sortIcon('SortOrder') }}</a>
                        </th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3 text-gray-600">{{ $item->IdPropinsi }}</td>
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $item->Propinsi }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $item->IdNegara }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $item->SortOrder }}</td>
                        <td class="px-5 py-3 text-right space-x-2">
                            <a href="/propinsi/{{ $item->IdPropinsi }}/edit"
                               class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                            <form action="/propinsi/{{ $item->IdPropinsi }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Tidak ada data ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="flex justify-between items-center px-5 py-4 border-t border-gray-100">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $data->count() }} dari {{ $data->total() }} data
            </p>
            <div class="flex items-center gap-1">
                @if($data->onFirstPage())
                    <span class="px-3 py-1 text-sm text-gray-300">‹ Previous</span>
                @else
                    <a href="{{ $data->previousPageUrl() }}"
                       class="px-3 py-1 text-sm text-gray-600 hover:text-blue-600">‹ Previous</a>
                @endif

                @for($i = 1; $i <= $data->lastPage(); $i++)
                    @if($i == $data->currentPage())
                        <span class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm">{{ $i }}</span>
                    @else
                        <a href="{{ $data->url($i) }}"
                           class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-md">{{ $i }}</a>
                    @endif
                @endfor

                @if($data->hasMorePages())
                    <a href="{{ $data->nextPageUrl() }}"
                       class="px-3 py-1 text-sm text-gray-600 hover:text-blue-600">Next ›</a>
                @else
                    <span class="px-3 py-1 text-sm text-gray-300">Next ›</span>
                @endif
            </div>
        </div>

    </div>

@endsection