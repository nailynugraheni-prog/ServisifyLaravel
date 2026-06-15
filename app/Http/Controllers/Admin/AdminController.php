<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products     = DataHelper::getProducts();
        $transactions = DataHelper::getTransactions();
        $users        = array_filter(DataHelper::getUsers(), fn($u) => $u['role'] === 'user');

        $stats = [
            'total_produk'     => count($products),
            'total_transaksi'  => count($transactions),
            'total_pengguna'   => count(array_values($users)),
            'pending'          => count(array_filter($transactions, fn($t) => $t['status'] === 'pending')),
            'proses'           => count(array_filter($transactions, fn($t) => $t['status'] === 'proses')),
            'selesai'          => count(array_filter($transactions, fn($t) => $t['status'] === 'selesai')),
            'total_pendapatan' => array_sum(array_column(array_filter($transactions, fn($t) => $t['status'] === 'selesai'), 'total')),
        ];
        $recentTrx = array_slice(array_reverse($transactions), 0, 5);
        return view('admin.dashboard', compact('stats', 'recentTrx'));
    }
}