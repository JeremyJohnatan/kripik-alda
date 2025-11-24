@extends('layouts.app')

@section('content')
<div class="max-w-screen-md mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-semibold text-center mb-6">Daftar Keranjang</h2>

    {{-- Flash message --}}
    @if(session()->has('success'))
        <div class="border border-green-200 bg-green-50 px-4 py-2 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Tambah Keranjang --}}
    <div class="flex justify-end mb-4">
        <a href="{{ route('keranjang.create') }}"
           class="bg-indigo-600 text-black px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Produk ke Keranjang
        </a>
    </div>

    {{-- Tabel data --}}
    <div class="w-full border border-gray-200 rounded-xl overflow-x-auto bg-white">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 text-slate-800">
                <tr class="divide-x divide-gray-200">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">ID User</th>
                    <th class="px-4 py-2 text-left">Nama Produk</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white text-slate-800">
                @foreach ($keranjangs as $keranjang)
                    <tr class="divide-x divide-gray-200">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $keranjang->user->name }}</td>
                        <td class="px-4 py-2">{{ $keranjang->produk->Nama_Produk }}</td>
                        <td class="px-4 py-2">{{ $keranjang->Jumlah }}</td>
                        <td class="px-4 py-2" style="width:180px;">
                            <div class="flex items-center justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('keranjang.edit', $keranjang->ID_Keranjang) }}"
                                   class="bg-yellow-500 text-black text-sm px-3 py-1 rounded">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('keranjang.destroy', $keranjang->ID_Keranjang) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus produk ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white text-sm px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-5">
        {!! $keranjangs->links() !!}
    </div>
</div>
@endsection
