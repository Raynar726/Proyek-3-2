<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Online</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">

    <h2>Toko Online</h2>
    
    <!-- Cek apakah user sudah login atau belum -->
    @auth
        <p>
            Halo, <strong>{{ Auth::user()->nama_lengkap }}</strong>! | 
            <a href="/keranjang">[ Keranjang Belanja ]</a> | 
            <a href="/riwayat-pesanan">[ Riwayat Pesanan ]</a> | 
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </p>
    @else
        <p><a href="{{ route('login') }}">[ Login untuk Membeli ]</a></p>
    @endauth
    
    <hr>

    <h3>Daftar Barang</h3>
    <ul style="list-style-type: none; padding: 0;">
        @foreach($products as $product)
            <li style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; max-width: 300px;">
                <img src="{{ asset('images/' . $product->gambar) }}" alt="{{ $product->nama_barang }}" style="max-width: 100%;">
                
                <!-- Nama, Harga, Stok -->
                <h4 style="margin: 10px 0 5px 0;">{{ $product->nama_barang }}</h4>
                <p style="margin: 0 0 10px 0; font-size: 14px; color: #555;">{{ $product->deskripsi }}</p>
                
                <strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}<br>
                <strong>Stok:</strong> {{ $product->stok > 0 ? $product->stok : 'Habis' }}<br><br>

                <!-- Logika Tombol Beli / Stok Habis / Harus Login -->
                @if($product->stok > 0)
                    @auth
                        <!-- Jika stok ada dan sudah login -->
                        <form action="/keranjang/add/{{ $product->id_barang }}" method="POST">
                            @csrf
                            <button type="submit" style="cursor: pointer;">Masukkan ke keranjang</button>
                        </form>
                    @else
                        <!-- Jika stok ada tapi belum login -->
                        <a href="{{ route('login') }}"><button style="cursor: pointer;">Login untuk Membeli</button></a>
                    @endauth
                @else
                    <!-- Jika stok 0 -->
                    <button disabled style="background-color: #ddd; cursor: not-allowed;">Stok Kosong</button>
                @endif
            </li>
        @endforeach
    </ul>

</body>
</html>