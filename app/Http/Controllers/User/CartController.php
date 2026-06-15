<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = DataHelper::getCart();
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        return view('user.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $productId = (int) $request->product_id;
        $products  = DataHelper::getProducts();
        $product   = null;

        foreach ($products as $p) {
            if ($p['id'] === $productId) {
                $product = $p;
                break;
            }
        }

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = DataHelper::getCart();
        $found = false;

        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['qty']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id'   => $productId,
                'product_name' => $product['name'],
                'price'        => $product['price'],
                'category'     => $product['category'],
                'image'        => $product['image'],
                'qty'          => 1,
            ];
        }

        DataHelper::saveCart($cart);

        return back()->with('success', '"' . $product['name'] . '" berhasil ditambahkan ke keranjang!');
    }

    public function remove(int $id)
    {
        $cart = DataHelper::getCart();
        $cart = array_values(array_filter($cart, fn($i) => $i['product_id'] !== $id));

        DataHelper::saveCart($cart);

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function update(Request $request)
    {
        $cart = DataHelper::getCart();

        foreach ($cart as &$item) {
            $key = 'qty_' . $item['product_id'];

            if ($request->has($key)) {
                $qty = (int) $request->input($key);
                $item['qty'] = max(1, $qty);
            }
        }

        DataHelper::saveCart($cart);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }
}