<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $query = DetailTransaksi::query()->with('product', 'transaksi');

        $query = $this->applyFilter($query, $filter);

        $product_sold = $query->sum('jumlah');

        $product_fav = (clone $query)
            ->select('id_produk', DB::raw('SUM(jumlah) as total_jumlah'))
            ->groupBy('id_produk')
            ->orderByDesc('total_jumlah')
            ->with('product')
            ->first();

        $product_least = (clone $query)
            ->select('id_produk', DB::raw('SUM(jumlah) as total_jumlah'))
            ->groupBy('id_produk')
            ->orderBy('total_jumlah', 'ASC')
            ->with('product')
            ->first();

        $revenue = $query->sum('subtotal');

        // Donut chart data
        $donut = (clone $query)
            ->select('id_produk', DB::raw('SUM(jumlah) as total_jumlah'))
            ->groupBy('id_produk')
            ->with('product')
            ->orderByDesc('total_jumlah')
            ->get();

        // Bar chart
        $bar = (clone $query)
            ->join('transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->select(
                'transaksi.tanggal',
                DB::raw('SUM(detail_transaksi.jumlah) as total_jumlah')
            )
            ->groupBy('transaksi.tanggal')
            ->orderBy('transaksi.tanggal')
            ->get();

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

        return view('dashboard', compact(
            'filter',
            'product_sold',
            'product_fav',
            'product_least',
            'revenue',
            'donut',
            'bar',
            'transaksi'
        ));
    }

    private function applyFilter($query, $filter)
    {
        if (!$filter) return $query;

        switch ($filter) {
            case 'Harian':
                $query->whereDate('detail_transaksi.created_at', today());
                break;

            case 'Mingguan':
                $query->whereBetween('detail_transaksi.created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
                break;

            case 'Bulanan':
                $query->whereMonth('detail_transaksi.created_at', now()->month)
                    ->whereYear('detail_transaksi.created_at', now()->year);
                break;

            case 'Tahunan':
                $query->whereYear('detail_transaksi.created_at', now()->year);
                break;

            case 'Pedas':
                $query->whereHas('product', function ($q) {
                    $q->where('rasa', 'Pedas');
                });
                break;
        }

        return $query;
    }
}
