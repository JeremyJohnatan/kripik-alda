<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Produk'  => 'required',
            'Deskripsi'    => 'required',
            'Harga'        => 'required|numeric',
            'Stok'         => 'required|integer',
            'Item_Produk'  => 'required',
        ]);

        Product::create([
            'Nama_Produk' => $request->Nama_Produk,
            'Deskripsi'   => $request->Deskripsi,
            'Harga'       => $request->Harga,
            'Stok'        => $request->Stok,
            'Item_Produk' => $request->Item_Produk,
        ]);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Nama_Produk'  => 'required',
            'Deskripsi'    => 'required',
            'Harga'        => 'required|numeric',
            'Stok'         => 'required|integer',
            'Item_Produk'  => 'required',
        ]);

        $product->update([
            'Nama_Produk' => $request->Nama_Produk,
            'Deskripsi'   => $request->Deskripsi,
            'Harga'       => $request->Harga,
            'Stok'        => $request->Stok,
            'Item_Produk' => $request->Item_Produk,
        ]);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Product deleted successfully');
    }
}
