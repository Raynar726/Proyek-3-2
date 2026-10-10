<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart');

        // Cegah checkout kalau keranjang kosong
        if (!$cart || count($cart) == 0) {
            return redirect('/keranjang');
        }

        // Hitung total harga
        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }

        // Bikin ID Order unik
        $id_order = 'ORD-' . strtoupper(Str::random(7));

        // Simpan ke tabel orders
        Order::create([
            'id_order'          => $id_order,
            'id_user'           => Auth::user()->id_user,
            'tanggal_order'     => now(),
            'total_harga'       => $totalHarga,
            'alamat_pengiriman' => Auth::user()->alamat,
        ]);

        // Simpan ke order_details kurangi stok barang
        foreach ($cart as $id_barang => $item) {
            OrderDetail::create([
                'id_order'     => $id_order,
                'id_barang'    => $id_barang,
                'harga_satuan' => $item['harga'],
                'jumlah_beli'  => $item['jumlah'],
            ]);

            // Proses kurangi stok
            $product = Product::find($id_barang);
            if ($product) {
                $product->stok -= $item['jumlah'];
                $product->save();
            }
        }

        // Kosongkan keranjang
        session()->forget('cart');

        // Arahkan ke halaman riwayat pesanan
        return redirect('/riwayat-pesanan')->with('success', 'Checkout berhasil! Pesanan Anda telah dibuat.');
        }

    public function history() {
        $orders = Order::where('id_user', Auth::user()->id_user)
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('riwayat', compact('orders'));
    }
}