<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalHarga = 0;

        foreach($cart as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }

        return view('keranjang', compact('cart', 'totalHarga'));
    }

    // Menambah barang ke keranjang
    public function add(Request $request, $id_barang)
    {
        $product = Product::find($id_barang);
        if(!$product) return redirect('/');

        $cart = session()->get('cart', []);

        // Jika barang sudah ada, tambah jumlahnya
        if(isset($cart[$id_barang])) {
            // Validasi: Jumlah tidak boleh melebihi stok
            if($cart[$id_barang]['jumlah'] < $product->stok) {
                $cart[$id_barang]['jumlah']++;
            }
        } else {
            // Jika belum ada, masukkan sebagai barang baru
            $cart[$id_barang] = [
                "id_barang" => $product->id_barang,
                "nama_barang" => $product->nama_barang,
                "jumlah" => 1,
                "harga" => $product->harga,
                "stok" => $product->stok
            ];
        }

        session()->put('cart', $cart);
        return redirect('/keranjang');
    }

    // Mengubah jumlah barang (+ atau -)
    public function update(Request $request, $id_barang)
    {
        $cart = session()->get('cart');
        $action = $request->action;
        
        if(isset($cart[$id_barang])) {
            if($action == 'plus') {
                if($cart[$id_barang]['jumlah'] < $cart[$id_barang]['stok']) {
                    $cart[$id_barang]['jumlah']++;
                }
            } elseif($action == 'minus') {
                if($cart[$id_barang]['jumlah'] > 1) {
                    $cart[$id_barang]['jumlah']--;
                } else {
                    unset($cart[$id_barang]); // Hapus jika jumlahnya 0
                }
            }
            session()->put('cart', $cart);
        }
        return redirect('/keranjang');
    }

    // Menghapus 1 jenis barang dari keranjang
    public function remove($id_barang)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id_barang])) {
            unset($cart[$id_barang]);
            session()->put('cart', $cart);
        }
        return redirect('/keranjang');
    }

    // Mengosongkan semua isi keranjang
    public function clear()
    {
        session()->forget('cart');
        return redirect('/keranjang');
    }
}