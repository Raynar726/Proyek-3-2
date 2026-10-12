<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private array $products = [
        1 => ['name' => 'Buku Tulis', 'price' => 5000],
        2 => ['name' => 'Pulpen', 'price' => 3000],
        3 => ['name' => 'Penggaris', 'price' => 4000],
    ];

    public function index()
    {
        return view('shop');
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'cart' => ['present', 'array'],
            'cart.*' => ['integer', 'min:1', 'max:99'],
            'product_id' => ['required', 'integer'],
        ]);

        $cart = $data['cart'];
        $id = (int) $data['product_id'];

        abort_unless(isset($this->products[$id]), 404);

        $cart[$id] = min(99, ($cart[$id] ?? 0) + 1);

        return response()->json($this->calculate($cart));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cart' => ['present', 'array'],
            'cart.*' => ['integer', 'min:1', 'max:99'],
        ]);

        return response()->json(
            $this->calculate($data['cart'])
        );
    }

    private function calculate(array $cart): array
    {
        $items = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            if (!isset($this->products[$id])) {
                continue;
            }

            $product = $this->products[$id];
            $subtotal = $product['price'] * $quantity;

            $items[] = [
                'id' => (int) $id,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        return [
            'items' => $items,
            'total' => $total,
        ];
    }
}
