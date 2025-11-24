<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksis = Transaksi::with('user')->paginate(10); // Pagination
        return view('transaksi.index', compact('transaksis'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('transaksi.create', compact('users'));
    }

    // Menyimpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'ID_User' => 'required|exists:users,id',
            'Tanggal' => 'required|date',
            'Status_Pembayaran' => 'required|in:pending,paid,canceled',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        // Pastikan menggunakan ID_Transaksi
        $transaksi = Transaksi::with('user')->where('ID_Transaksi', $id)->firstOrFail();
        return view('transaksi.show', compact('transaksi'));
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        // Pastikan menggunakan ID_Transaksi
        $transaksi = Transaksi::where('ID_Transaksi', $id)->firstOrFail(); 
        $users = User::all(); 
        return view('transaksi.edit', compact('transaksi', 'users'));
    }

    // Menyimpan perubahan pada transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_User' => 'required|exists:users,id',
            'Tanggal' => 'required|date',
            'Status_Pembayaran' => 'required|in:pending,paid,canceled',
        ]);

        // Pastikan menggunakan ID_Transaksi
        $transaksi = Transaksi::where('ID_Transaksi', $id)->firstOrFail();
        $transaksi->update($request->all());  // Update data transaksi
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        // Pastikan menggunakan ID_Transaksi
        $transaksi = Transaksi::where('ID_Transaksi', $id)->firstOrFail(); 
        $transaksi->delete();  // Menghapus transaksi
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
