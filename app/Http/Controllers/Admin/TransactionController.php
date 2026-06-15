<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = array_reverse(DataHelper::getTransactions());
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(string $id)
    {
        $transactions = DataHelper::getTransactions();
        $trx = null;
        foreach ($transactions as $t) { if ($t['id'] === $id) { $trx = $t; break; } }
        if (!$trx) return redirect()->route('admin.transaksi.index');
        return view('admin.transactions.show', compact('trx'));
    }

    public function update(Request $request, string $id)
    {
        $transactions = DataHelper::getTransactions();
        foreach ($transactions as &$t) {
            if ($t['id'] === $id) { $t['status'] = $request->status; break; }
        }
        DataHelper::saveTransactions($transactions);
        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $transactions = array_values(array_filter(DataHelper::getTransactions(), fn($t) => $t['id'] !== $id));
        DataHelper::saveTransactions($transactions);
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}