<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $barangs = \App\Models\Barang::all();
        $cart = session()->get('cart', []);
        $totalItems = array_sum($cart); // Menghitung total item dalam keranjang

        return view('katalog', compact('barangs', 'cart', 'totalItems'));
    }

    public function cart() {
        $cart = session()->get('cart', []);
        $barangs = \App\Models\Barang::whereIn('id', array_keys($cart))->get();
        
        $totalHarga = 0;
        foreach ($barangs as $barang) {
            $totalHarga += $barang->harga * $cart[$barang->id];
        }
        
        return view('keranjang', compact('cart', 'barangs', 'totalHarga'));
    }

    public function add($id) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);
        return back();
    }

    public function updateQty(Request $request, $id) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            if ($request->action == 'plus') {
                $cart[$id]++;
            } elseif ($request->action == 'minus') {
                $cart[$id]--;
                if ($cart[$id] <= 0) {
                    unset($cart[$id]);
                }
            }
            session()->put('cart', $cart);
        }

        return back();
    }

    public function remove($id) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back();
    }

    public function clear() {
        session()->forget('cart');
        return back();
    }
}