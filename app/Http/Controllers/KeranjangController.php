<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\User;
use App\Models\Product;   // <-- benar
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Menampilkan daftar keranjang
    public function index()
    {
        $keranjangs = Keranjang::with(['user', 'produk'])->paginate(10);
        return view('keranjang.index', compact('keranjangs'));
    }

    // Menampilkan form tambah keranjang
    public function create()
    {
        $users = User::all();
        $produk = Product::all();  // <-- benar
        return view('keranjang.create', compact('users', 'produk'));
    }

    // Menyimpan keranjang
    public function store(Request $request)
    {
        $request->validate([
            'ID_User' => 'required|exists:users,id',
            'ID_Produk' => 'required|exists:product,ID_Produk',
            'Jumlah' => 'required|integer|min:1',
        ]);

        Keranjang::create([
            'ID_User' => $request->ID_User,
            'ID_Produk' => $request->ID_Produk,
            'Jumlah' => $request->Jumlah,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Menampilkan form edit keranjang
    public function edit($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $users = User::all();
        $produk = Product::all(); // <-- benar
        return view('keranjang.edit', compact('keranjang', 'users', 'produk'));
    }

    // Update keranjang
    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_User' => 'required|exists:users,id',
            'ID_Produk' => 'required|exists:product,ID_Produk',
            'Jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);

        $keranjang->update([
            'ID_User' => $request->ID_User,
            'ID_Produk' => $request->ID_Produk,
            'Jumlah' => $request->Jumlah,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Menghapus keranjang
    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
