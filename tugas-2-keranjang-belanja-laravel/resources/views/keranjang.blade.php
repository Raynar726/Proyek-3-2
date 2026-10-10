<h2>Keranjang belanja</h2>
<a href="{{ route('katalog') }}">Kembali ke Katalog</a>

<ul>
    @foreach($barangs as $b)
        @php 
            $qty = $cart[$b->id];
            $subtotal = $b->harga * $qty;
        @endphp
        <li>
            {{ $b->nama_barang }} <br>
            Rp {{ number_format($b->harga, 0, ',', '.') }} x {{ $qty }} = Rp {{ number_format($subtotal, 0, ',', '.') }}
            
            <form action="/tugas2/keranjang/update/{{ $b->id }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="action" value="minus">
                <button type="submit">-</button>
            </form>
            {{ $qty }}
            <form action="/tugas2/keranjang/update/{{ $b->id }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="action" value="plus">
                <button type="submit">+</button>
            </form>

            <form action="/tugas2/keranjang/remove/{{ $b->id }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>

<h3>Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h3>

<form action="/tugas2/keranjang/clear" method="POST">
    @csrf
    <button type="submit">Kosongkan keranjang</button>
</form>