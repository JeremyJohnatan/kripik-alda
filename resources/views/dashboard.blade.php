@extends('layouts.app')

@section('content')
<div class="ml-1 mb-4">
    <h1 class="fw-bold">Rincian Penjualan</h1>
</div>

<div class="d-flex flex-column-reverse justify-content-between mb-4 gap-3">

    <!-- Filter -->
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard', ['filter' => 'Harian']) }}"
        class="btn-sm btn-success-subtle {{ $filter == 'Harian' ? 'active' : '' }}">
        Harian
        </a>

        <a href="{{ route('dashboard', ['filter' => 'Mingguan']) }}"
        class="btn-sm btn-success-subtle {{ $filter == 'Mingguan' ? 'active' : '' }}">
        Mingguan
        </a>

        <a href="{{ route('dashboard', ['filter' => 'Bulanan']) }}"
        class="btn-sm btn-success-subtle {{ $filter == 'Bulanan' ? 'active' : '' }}">
        Bulanan
        </a>

        <a href="{{ route('dashboard', ['filter' => 'Tahunan']) }}"
        class="btn-sm btn-success-subtle {{ $filter == 'Tahunan' ? 'active' : '' }}">
        Tahunan
        </a>

        <a href="{{ route('dashboard', ['filter' => 'Pedas']) }}"
        class="btn-sm btn-success-subtle {{ $filter == 'Pedas' ? 'active' : '' }}">
        Pedas
        </a>
    </div>

    <!-- Action -->
    <div class="d-flex align-self-end gap-2">
        <a href="{{ route('product.create') }}" class="btn-success d-flex align-items-center p-2 gap-2">
            Cetak Laporan
        </a>
        <a href="{{ route('product.create') }}" class="btn-success d-flex align-items-center p-2 gap-2">
            Lihat Perkembangan Penjualan
        </a>
    </div>
</div>

<div class="row px-2 mb-4">
    <div class="col-lg-3 px-1">
        <div class="card shadow-sm p-3 d-flex align-items-center gap-3" style="border-radius: 25px;">
            <h5>Produk Yang Terjual</h5>
            <div class="d-flex flex-column align-items-center">
                <h2 style="color: var(--tg-body-font-color);" class="fw-bold">{{ $product_sold }}</h2>
                <label for="">Produk</label>
            </div>
        </div>
    </div>

    <div class="col-lg-3 px-1">
        <div class="card shadow-sm  p-3 d-flex align-items-center gap-3" style="border-radius: 25px;">
            <h5>Produk Terlaris</h5>
            <div class="d-flex flex-column">
                <h2 style="color: var(--tg-body-font-color);" class="align-self-center fw-bold">{{ $product_fav->total_jumlah }}</h2>
                <label for="">{{ $product_fav->product->nama_produk}}</label>
            </div>
        </div>
    </div>

    <div class="col-lg-3 px-1">
        <div class="card shadow-sm  p-3 d-flex align-items-center gap-3" style="border-radius: 25px;">
            <h5>Produk Kurang Laku</h5>
            <div class="d-flex flex-column">
                <h2 style="color: var(--tg-body-font-color);" class="align-self-center fw-bold">{{ $product_least->total_jumlah }}</h2>
                <label for="">{{ $product_least->product->nama_produk }}</label>
            </div>
        </div>
    </div>

    <div class="col-lg-3 px-1">
        <div class="card shadow-sm p-3 d-flex align-items-center gap-3" style="border-radius: 25px;">
            <h5>Total Pendapatan</h5>
            <div class="d-flex flex-column">
                <h2 style="color: var(--tg-body-font-color);" class="fw-bold">Rp {{ number_format($revenue, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row px-2 my-4">

    <!-- Donut Chart -->
    <div class="col-lg-4 px-1">
        <div class="card shadow-sm p-3 d-flex gap-3" style="border-radius: 25px;">
            <h5>Produk Terlaris</h5>
            <canvas id="donutChart"></canvas>
        </div>
    </div>

    <!-- Bar Chart -->
    <div class="col-lg-8 px-1">
        <div class="card shadow-sm p-3 d-flex gap-3" style="border-radius: 25px;">
            <h5>Pertumbuhan Bisnis</h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap card shadow-sm px-4 mt-4" style="border-radius: 35px;">
    <div class="sub-title mt-4">
        <h2>Pesanan</h2>
    </div>

    <div class="table mt-4">
        <table class="table mb-4">
            <thead class="border-top border-bottom border-dark">
                <tr>
                    <th class="fw-semibold py-3 text-start">Tanggal Pesanan</th>
                    <th class="fw-semibold py-3 text-center">Alamat</th>
                    <th class="fw-semibold py-3 text-center">Status Pembayaran</th>
                    <th class="fw-semibold py-3 text-center">Status Pengiriman</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td class="fw-semibold py-3 text-start">{{ $t->tanggal }}</td>
                    <td class="fw-semibold py-3 text-center">Alamat</td>
                    <td class="fw-semibold py-3 text-center">{{ $t->status_pembayaran }}</td>
                    <td class="fw-semibold py-3 text-center">Status Pengiriman</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // chart produk terlaris
    const donut = document.getElementById('donutChart');

    const donutLabels = @json($donut->pluck('product.nama_produk'));
    const donutValues = @json($donut->pluck('total_jumlah'));

    const donutData = {
        labels: donutLabels,
        datasets: [{
            label: 'Jumlah Terjual',
            data: donutValues,
            backgroundColor: [
                'rgb(75, 127, 82)',
                'rgb(125, 209, 129)',
                'rgb(150, 232, 188)',
                'rgb(182, 249, 201)',
                'rgb(201, 255, 226)'
            ],
            hoverOffset: 4
        }]
    };

    const configDonut = (donut, {
        type: 'doughnut',
        data: donutData,
        options: {
            responsive: true,
            plugins: {
            legend: {
                display: false,
            }
            }
        },
    });

    new Chart(donut, configDonut);

    // chart pertumbuhan bisnis
    const bar = document.getElementById('barChart');

    let barLabels = @json($bar->pluck('tanggal'));
    const barValues = @json($bar->pluck('total_jumlah'));

    barLabels = barLabels.map(t => {
        const d = new Date(t);
        return d.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    });

    const barData = {
        labels: barLabels,
        datasets: [{
            data: barValues,
            backgroundColor: ['rgb(19, 50, 35)'],
            hoverOffset: 4
        }]
    };

    const barConfig = {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    };

    new Chart(bar, barConfig);

</script>
@endpush
