@extends('layouts.app')

@section('content')

<div class="max-w-screen-md mx-auto flex items-center mt-10">
    <div class="w-full bg-white rounded-xl px-10 py-8">

        <h2 class="text-xl font-semibold mb-4">
            Edit Product
        </h2>

        <form action="{{ route('product.update', $product->ID_Produk) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block mb-1">Nama Produk</label>
                <input type="text" name="Nama_Produk"
                       value="{{ old('Nama_Produk', $product->Nama_Produk) }}"
                       class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-indigo-400">
                @error('Nama_Produk')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1">Deskripsi</label>
                <textarea name="Deskripsi"
                          class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-indigo-400">{{ old('Deskripsi', $product->Deskripsi) }}</textarea>
                @error('Deskripsi')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1">Harga</label>
                <input type="number" name="Harga"
                       value="{{ old('Harga', $product->Harga) }}"
                       class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-indigo-400">
                @error('Harga')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1">Stok</label>
                <input type="number" name="Stok"
                       value="{{ old('Stok', $product->Stok) }}"
                       class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-indigo-400">
                @error('Stok')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block mb-1">Item Produk</label>
                <input type="text" name="Item_Produk"
                       value="{{ old('Item_Produk', $product->Item_Produk) }}"
                       class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-indigo-400">
                @error('Item_Produk')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-center gap-5 mt-5">
                <a href="{{ route('product.index') }}"
                   class="text-white bg-amber-500 px-8 py-2 rounded">
                    Cancel
                </a>
                <button type="submit"
                        class="text-white bg-green-600 px-8 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
