<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/transaction">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user">User</a>
                    </li>
                </ul>
                <form action="/logout" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Daftar Transaksi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
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
                        <th>Action</th>
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
                        <td>
                            <a href="" class="btn btn-sm btn-warning mb-1">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-danger mb-1" onclick="return confirm('Batalkan pesanan ini?')">Batalkan</button>
                            </form>
                            <a href="https://wa.me/{{ $order->user->no_telf ?? '08xxxxxxxxxx' }}" target="_blank" class="btn btn-sm btn-success">Hubungi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
          const token = localStorage.getItem('token');
          const tableBody = document.getElementById('order-table-body');
      
          if (!token) {
            alert('Silakan login terlebih dahulu.');
            window.location.href = '/';
            return;
          }
      
          try {
            const response = await fetch('/api/transaction', {
              headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
              }
            });
      
            const data = await response.json();
      
            if (!response.ok) {
              throw new Error(data.message || 'Gagal mengambil data.');
            }
      
            // Kosongkan isi tbody dan masukkan data baru
            tableBody.innerHTML = '';
            data.forEach(order => {
              const row = `
                <tr>
                  <td>${order.id}</td>
                  <td>${order.user_id}</td>
                  <td>${order.menu_id}</td>
                  <td>${order.alamat}</td>
                  <td>${order.detail_rumah}</td>
                  <td>${order.jumlah}</td>
                  <td>${new Intl.NumberFormat('id-ID').format(order.total_harga)}</td>
                  <td>${order.tanggal_pemesanan}</td>
                  <td>${order.jam}</td>
                  <td>${order.status.charAt(0).toUpperCase() + order.status.slice(1)}</td>
                  <td>
                    <button class="btn btn-sm btn-warning mb-1" disabled>Edit</button>
                    <button class="btn btn-sm btn-danger mb-1" disabled>Batalkan</button>
                    <a href="https://wa.me/${order.user?.no_telf ?? '08xxxxxxxxxx'}" target="_blank" class="btn btn-sm btn-success">Hubungi</a>
                  </td>
                </tr>
              `;
              tableBody.insertAdjacentHTML('beforeend', row);
            });
      
          } catch (err) {
            alert('Gagal memuat transaksi: ' + err.message);
          }
        });
      </script>      
</body>
</html>
