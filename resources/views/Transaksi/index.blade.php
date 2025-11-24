@extends('layouts.app')

@section('content')

<div class="max-w-screen-md mx-auto flex items-center mt-10">
    <div class="w-full bg-white rounded-xl px-10 py-8">

        <h2 class="text-xl font-semibold mb-4">
            Daftar Transaksi
        </h2>

        {{-- Flash message --}}
        @if(session()->has('success'))
            <div class="border border-green-200 bg-green-50 px-4 py-2 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Add New --}}
        <div class="flex items-center justify-end mb-5">
            <a href="{{ route('transaksi.create') }}"
               class="inline-block text-sm font-semibold text-black bg-indigo-500 px-4 py-2 rounded hover:bg-indigo-600">
                Add New
            </a>
        </div>

        {{-- Tabel data --}}
        <div class="w-full border border-gray-200 rounded-xl overflow-x-auto bg-white">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-slate-800">
                    <tr class="divide-x divide-gray-200">
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">ID Transaksi</th>
                        <th class="px-4 py-2 text-left">ID User</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Status Pembayaran</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white text-slate-800">
                    @forelse ($transaksis as $transaksi)
                        <tr class="divide-x divide-gray-200">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td> <!-- Nomor urut -->
                            <td class="px-4 py-2">{{ $transaksi->ID_Transaksi }}</td>
                            <td class="px-4 py-2">{{ $transaksi->user->name }}</td>
                            <td class="px-4 py-2">{{ $transaksi->Tanggal }}</td>
                            <td class="px-4 py-2">{{ $transaksi->Status_Pembayaran }}</td>

                            <td class="px-4 py-2" style="width:180px;">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- EDIT --}}
                                    <form action="{{ route('transaksi.edit', $transaksi->ID_Transaksi) }}" method="GET">
                                        <button type="submit" class="bg-yellow-500 text-black text-sm px-3 py-1 rounded">
                                            Edit
                                        </button>
                                    </form>

                                    {{-- DELETE --}}
                                    <form action="{{ route('transaksi.destroy', $transaksi->ID_Transaksi) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white text-sm px-3 py-1 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-slate-500">
                                Tidak ada data transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-5">
            {!! $transaksis->links() !!} <!-- Menampilkan pagination -->
        </div>

    </div>
</div>

@endsection
