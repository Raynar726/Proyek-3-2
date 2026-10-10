<h2>Toko Alat Tulis</h2>
<a href="{{ route('keranjang') }}">[ Keranjang ({{ $totalItems }}) ]</a>

<h3>Daftar barang</h3>
<ul>
    @foreach($barangs as $b)
        <li>
            {{ $b->nama_barang }} - Rp {{ number_format($b->harga, 0, ',', '.') }}
            <form action="/tugas2/keranjang/add/{{ $b->id }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"> Masukkan ke keranjang </button>
            </form>
        </li>
    @endforeach
</ul>