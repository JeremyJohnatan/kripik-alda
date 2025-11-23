@extends('layouts.app')

@section('content')

<div class="max-w-screen-md mx-auto flex items-center mt-10">
    <div class="w-full bg-white rounded-xl px-10 py-8">

        <h2 class="text-3xl font-semibold mb-7">Detail Product</h2>

        {{-- Tidak perlu form untuk store, hanya tampilan detail --}}
        <div class="mb-3">
            <label class="block mb-1">Nama Produk</label>
            <input type="text"
                   value="{{ $product->Nama_Produk }}"
                   readonly
                   class="w-full bg-gray-50 border border-gray-300 px-4 py-2 rounded-md focus:outline-none">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Deskripsi</label>
            <textarea readonly
                      class="w-full bg-gray-50 border border-gray-300 px-4 py-2 rounded-md focus:outline-none">{{ $product->Deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Harga</label>
            <input type="text"
                   value="Rp {{ number_format($product->Harga, 0, ',', '.') }}"
                   readonly
                   class="w-full bg-gray-50 border border-gray-300 px-4 py-2 rounded-md focus:outline-none">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Stok</label>
            <input type="text"
                   value="{{ $product->Stok }}"
                   readonly
                   class="w-full bg-gray-50 border border-gray-300 px-4 py-2 rounded-md focus:outline-none">
        </div>

        <div class="mb-6">
            <label class="block mb-1">Item Produk</label>
            <input type="text"
                   value="{{ $product->Item_Produk }}"
                   readonly
                   class="w-full bg-gray-50 border border-gray-300 px-4 py-2 rounded-md focus:outline-none">
        </div>

        <div class="flex items-center justify-center gap-5">
            <a href="{{ route('product.index') }}"
               class="text-white bg-amber-500 px-8 py-2 rounded cursor-pointer">
                Back
            </a>
        </div>

    </div>
</div>

@endsection
