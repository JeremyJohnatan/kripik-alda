@extends('layouts.app')

@section('content')
<div class="ml-1 mb-4">
    <h1 class="fw-bold">Pesanan</h1>
</div>

<div class="d-flex h-100 flex-wrap card shadow-sm px-4" style="border-radius: 35px;">
    <div class="m-0 ms-2 me-4">
        <div class="d-flex justify-content-end">
        <a href="{{ route('pesanan.cetak.pdf') }}" class="btn-success d-flex align-items-center p-2 gap-2">
            <img src="{{ asset('assets/img/icons/lets-icons_paper-fill.svg') }}" alt=""> Cetak Laporan
        </a>
    </div>

    <div class="sub-title mt-0">
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
                    <th class="fw-semibold py-3 text-end">Detail Pesanan</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td class="fw-semibold py-3 text-start">{{ $t->tanggal }}</td>
                    <td class="fw-semibold py-3 text-center">Alamat</td>
                    <td class="fw-semibold py-3 text-center">{{ $t->status_pembayaran }}</td>
                    <td class="fw-semibold py-3 text-center">Status Pengiriman</td>
                    <td class="fw-semibold py-3 text-end">
                        <a href="#" class="btn-success-subtle"
                        data-bs-toggle="modal"
                        data-bs-target="#detailModal-{{ $t->id_transaksi }}">
                        Detail Pesanan {{ $t->id_transaksi }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal detail pesanan -->
        @foreach($transaksi as $t)
        <div class="modal fade" id="detailModal-{{ $t->id_transaksi }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background-color: #fff !important;">

                    <div class="modal-header border-0">
                        <h5 class="modal-title">Detail Pesanan #{{ $t->id_transaksi }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>Tanggal:</strong> {{ $t->tanggal }}</p>
                        <p><strong>Status Pembayaran:</strong> {{ $t->status_pembayaran }}</p>

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($t->detail as $d)
                                <tr>
                                    <td>{{ $d->product->nama_produk }}</td>
                                    <td class="text-center">{{ $d->total_jumlah }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer border-0">
                        <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection
