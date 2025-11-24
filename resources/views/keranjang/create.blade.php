@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-semibold text-center mb-6">Tambah Produk ke Keranjang</h2>

    <form action="{{ route('keranjang.store') }}" method="POST">
        @csrf

        {{-- ID User --}}
        <div class="mb-4">
            <label for="ID_User" class="block text-sm font-medium text-gray-700">ID User</label>
            <select class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" name="ID_User" id="ID_User" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- ID Produk --}}
        <div class="mb-4">
            <label for="ID_Produk" class="block text-sm font-medium text-gray-700">Produk</label>
            <select name="ID_Produk" id="ID_Produk"
                    class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @foreach($produk as $item)
                    <option value="{{ $item->ID_Produk }}">{{ $item->Nama_Produk }}</option>
                @endforeach
            </select>
        </div>


        {{-- Jumlah --}}
        <div class="mb-4">
            <label for="Jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" name="Jumlah" required min="1">
        </div>

        {{-- Tombol Simpan --}}
        <div class="mt-6 flex justify-center">
            <button type="submit" class="w-full bg-indigo-500 text-black py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Simpan ke Keranjang
            </button>
        </div>
    </form>
</div>
@endsection
