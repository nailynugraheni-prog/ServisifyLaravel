<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showPayment()
    {
        $cart = DataHelper::getCart();
        if (empty($cart)) {
            return redirect()->route('user.keranjang.index')->with('error', 'Keranjang kosong.');
        }

        $user = session('user');
        $transactions = DataHelper::getTransactions();

        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        $isFirstTransaction = !array_filter($transactions, function ($t) use ($user) {
            return $t['user_id'] === $user['id'];
        });

        $discountPercent = $isFirstTransaction ? 30 : 0;
        $discountAmount  = round($subtotal * $discountPercent / 100);
        $total           = $subtotal - $discountAmount;

        return view('user.payment.index', compact(
            'cart',
            'subtotal',
            'discountPercent',
            'discountAmount',
            'total',
            'isFirstTransaction'
        ));
    }

    public function processPayment(Request $request)
    {
        $cart = DataHelper::getCart();
        if (empty($cart)) {
            return redirect()->route('user.keranjang.index')->with('error', 'Keranjang kosong.');
        }

        $user = session('user');
        $transactions = DataHelper::getTransactions();

        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        $isFirstTransaction = !array_filter($transactions, function ($t) use ($user) {
            return $t['user_id'] === $user['id'];
        });

        $discountPercent = $isFirstTransaction ? 30 : 0;
        $discountAmount  = round($subtotal * $discountPercent / 100);
        $finalTotal      = $subtotal - $discountAmount;

        $items = array_map(fn($i) => [
            'product_id'   => $i['product_id'],
            'product_name' => $i['product_name'],
            'price'        => $i['price'],
            'qty'          => $i['qty'],
        ], $cart);

        $status = ($request->payment_method === 'cod') ? 'pending' : 'lunas';

        $newTrx = [
            'id'                   => DataHelper::generateTransactionId(),
            'user_id'              => $user['id'],
            'user_name'            => $user['name'],
            'items'                => $items,
            'subtotal'             => $subtotal,
            'discount_percent'     => $discountPercent,
            'discount_amount'      => $discountAmount,
            'total'                => $finalTotal,
            'status'               => $status,
            'payment_method'       => $request->payment_method,
            'address'              => $request->address,
            'notes'                => $request->notes ?? '',
            'is_first_transaction' => $isFirstTransaction,
            'created_at'           => now()->toDateString(),
        ];

        $transactions[] = $newTrx;
        DataHelper::saveTransactions($transactions);
        DataHelper::saveCart([]);

        return redirect()->route('user.history.index')
            ->with('success', 'Pesanan berhasil dibuat! ID Transaksi: ' . $newTrx['id']);
    }

    public function history()
    {
        $user = session('user');
        $transactions = DataHelper::getTransactions();

        $myTrx = array_filter($transactions, fn($t) => $t['user_id'] === $user['id']);
        $myTrx = array_reverse(array_values($myTrx));

        return view('user.history.index', compact('myTrx'));
    }

    public function historyDetail(string $id)
    {
        $user = session('user');
        $transactions = DataHelper::getTransactions();
        $trx = null;

        foreach ($transactions as $t) {
            if ($t['id'] === $id && $t['user_id'] === $user['id']) {
                $trx = $t;
                break;
            }
        }

        if (!$trx) {
            return redirect()->route('user.history.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('user.history.show', compact('trx'));
    }
}