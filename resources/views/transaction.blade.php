<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <!-- Bootstrap CSS (Optional, untuk styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Daftar Transaksi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Menu ID</th>
                        <th>Alamat</th>
                        <th>Detail Rumah</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Jam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->menu_id }}</td>
                        <td>{{ $order->alamat }}</td>
                        <td>{{ $order->detail_rumah }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->tanggal_pemesanan }}</td>
                        <td>{{ $order->jam }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, untuk interaktivitas) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
