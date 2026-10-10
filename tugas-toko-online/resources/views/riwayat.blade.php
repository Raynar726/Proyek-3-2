<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - Toko Online</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    <h2>Riwayat Pesanan Saya</h2>
    <a href="/">[ Kembali ke Daftar Barang ]</a>
    <hr>

    @if($orders->isEmpty())
        <p>Anda belum memiliki riwayat pesanan.</p>
    @else
        <ul style="list-style-type: none; padding: 0;">
            @foreach($orders as $order)
                <li style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; max-width: 500px;">
                    <strong>ID Pesanan: {{ $order->id_order }}</strong><br>
                    Tanggal: {{ $order->tanggal_order }}<br>
                    Alamat Pengiriman: {{ $order->alamat_pengiriman }}<br>
                    <h4 style="margin: 10px 0 5px 0;">Total Bayar: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h4>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>