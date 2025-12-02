<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with([
                'detail' => function ($q) {
                    $q->select(
                        'id_transaksi',
                        'id_produk',
                        DB::raw('SUM(jumlah) as total_jumlah')
                    )
                    ->groupBy('id_transaksi', 'id_produk');
                },
                'detail.product'
            ])->get();

        return view('pesanan.index', compact('transaksi'));
    }

    public function cetakPdf()
    {
        $transaksi = Transaksi::with([
            'detail' => function ($q) {
                $q->select(
                    'id_transaksi',
                    'id_produk',
                    DB::raw('SUM(jumlah) as total_jumlah')
                )->groupBy('id_transaksi', 'id_produk');
            },
            'detail.product'
        ])->get();

        $pdf = Pdf::loadView('pesanan.cetak-pdf', compact('transaksi'));
        return $pdf->download('laporan_pesanan.pdf');
    }
}
