<html>
<head>
    <title>Cetak Laporan Pesanan</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        h2 { margin-bottom: 10px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        .transaksi-header {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Laporan Pesanan</h2>

@foreach($transaksi as $t)

    <div class="transaksi-header">
        Transaksi #{{ $t->id_transaksi }} — {{ $t->tanggal }} <br>
        Alamat <br>
        Status Pembayaran: {{ $t->status_pembayaran }} <br>
        Status Pengiriman
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>
            @foreach($t->detail as $d)
            <tr>
                <td>{{ $d->product->nama_produk }}</td>
                <td>{{ $d->total_jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endforeach

<script>
    window.print();
</script>

</body>
</html>
