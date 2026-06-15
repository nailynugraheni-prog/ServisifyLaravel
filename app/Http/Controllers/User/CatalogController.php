<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $products   = DataHelper::getProducts();
        $categories = DataHelper::getCategories();
        $category   = $request->query('kategori');
        $search     = $request->query('search');

        $filtered = array_filter($products, function ($p) use ($category, $search) {
            $matchCat    = !$category || $p['category'] === $category;
            $matchSearch = !$search   || stripos($p['name'], $search) !== false;
            return $matchCat && $matchSearch && $p['is_active'];
        });

        // Group by category
        $grouped = [];
        foreach ($categories as $cat) {
            $grouped[$cat] = array_filter($products, fn($p) => $p['category'] === $cat && $p['is_active']);
        }

        return view('user.catalog.index', compact('filtered', 'grouped', 'categories', 'category', 'search', 'products'));
    }

    public function show(int $id)
    {
        $products = DataHelper::getProducts();
        $product  = null;
        foreach ($products as $p) {
            if ($p['id'] == $id) { $product = $p; break; }
        }
        if (!$product) return redirect()->route('user.katalog.index')->with('error', 'Produk tidak ditemukan.');

        $related = array_filter($products, fn($p) => $p['category'] === $product['category'] && $p['id'] !== $product['id'] && $p['is_active']);

        return view('user.catalog.show', compact('product', 'related'));
    }
}