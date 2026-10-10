<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang - Toko Online</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    <h2>Keranjang Belanja</h2>
    <a href="/">[ Kembali ke Daftar Barang ]</a>
    <hr>

    @if(session('cart') && count(session('cart')) > 0)
        <ul style="list-style-type: none; padding: 0;">
            @foreach(session('cart') as $id => $details)
                <li style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; max-width: 400px;">
                    <strong>{{ $details['nama_barang'] }}</strong><br>
                    Harga: Rp {{ number_format($details['harga'], 0, ',', '.') }}<br>
                    
                    <!-- Tombol Minus, Angka, dan Tombol Plus -->
                    <form action="/keranjang/update/{{ $id }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="action" value="minus">
                        <button type="submit">-</button>
                    </form>
                    
                    <strong> {{ $details['jumlah'] }} </strong>
                    
                    <form action="/keranjang/update/{{ $id }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="action" value="plus">
                        <button type="submit">+</button>
                    </form>
                    <br><br>

                    <!-- Subtotal Per Barang -->
                    Subtotal: <strong>Rp {{ number_format($details['harga'] * $details['jumlah'], 0, ',', '.') }}</strong><br>

                    <!-- Tombol Hapus Barang -->
                    <form action="/keranjang/remove/{{ $id }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <button type="submit" style="color: red; cursor: pointer;">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h3>Total Bayar: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h3>

        <!-- Tombol Kosongkan Keranjang -->
        <form action="/keranjang/clear" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="cursor: pointer;">Kosongkan Keranjang</button>
        </form>

        <!-- Tombol Checkout (akan kita buat rutenya nanti) -->
        <form action="/checkout" method="POST" style="display:inline; margin-left: 10px;">
            @csrf
            <button type="submit" style="background-color: green; color: white; padding: 5px 10px; cursor: pointer;">Checkout</button>
        </form>

    @else
        <p>Keranjang kamu masih kosong.</p>
    @endif
</body>
</html>