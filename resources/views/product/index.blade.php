@extends('layouts.app')

@section('content')

<div class="max-w-screen-md mx-auto flex items-center mt-10">
    <div class="w-full bg-white rounded-xl px-10 py-8">

        <h2 class="text-xl font-semibold mb-4">
            Product Lists
        </h2>

        {{-- Flash message --}}
        @if(session()->has('success'))
            <div class="border border-green-200 bg-green-50 px-4 py-2 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Add New --}}
        <div class="flex items-center justify-end mb-5">
            <a href="{{ route('product.create') }}"
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
                        <th class="px-4 py-2 text-left">Nama Produk</th>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Stok</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white text-slate-800">
                    @forelse ($products as $product)
                        <tr class="divide-x divide-gray-200">
                            <td class="px-4 py-2">{{ ++$i }}</td>

                            {{-- Nama dan deskripsi dari database --}}
                            <td class="px-4 py-2">{{ $product->Nama_Produk }}</td>
                            <td class="px-4 py-2">{{ $product->Deskripsi }}</td>

                            {{-- Harga dan stok dari database --}}
                            <td class="px-4 py-2">
                                Rp {{ number_format($product->Harga, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $product->Stok }}
                            </td>

                            <td class="px-4 py-2" style="width:180px;">
                                <div class="flex items-center justify-center gap-2">
                            
                                {{-- SHOW --}}
                            <form action="{{ route('product.show', $product->ID_Produk) }}" method="GET">
                                <button type="submit"
                                    class="bg-red-500 text-black text-sm px-3 py-1 rounded">
                                    show
                                </button>
                            </form>

                            {{-- EDIT --}}
                            <form action="{{ route('product.edit', $product->ID_Produk) }}" method="GET">
                                <button type="submit"
                                    class="bg-red-500 text-black text-sm px-3 py-1 rounded">
                                    edit
                                </button>
                            </form>


                                    <form action="{{ route('product.destroy', $product->ID_Produk) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-black text-sm px-3 py-1 rounded">
                                            delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-slate-500">
                                Belum ada data product.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {!! $products->links() !!}
        </div>

    </div>
</div>

@endsection
