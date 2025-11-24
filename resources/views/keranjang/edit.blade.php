@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-semibold text-center mb-6">Edit Keranjang</h2>

    <form action="{{ route('keranjang.update', $keranjang->ID_Keranjang) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ID User --}}
        <div class="mb-4">
            <label for="ID_User" class="block text-sm font-medium text-gray-700">User</label>
            <select name="ID_User" id="ID_User"
                    class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $keranjang->ID_User == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
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
                    <option value="{{ $item->ID_Produk }}"
                        {{ $keranjang->ID_Produk == $item->ID_Produk ? 'selected' : '' }}>
                        {{ $item->Nama_Produk }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah --}}
        <div class="mb-4">
            <label for="Jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="Jumlah" id="Jumlah" min="1"
                   value="{{ $keranjang->Jumlah }}"
                   class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        {{-- Tombol submit --}}
        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-indigo-600 text-black py-2 px-4 rounded-md hover:bg-indigo-700">
                Update Keranjang
            </button>
        </div>
    </form>
</div>
@endsection
