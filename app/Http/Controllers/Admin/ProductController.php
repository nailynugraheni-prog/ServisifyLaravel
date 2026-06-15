<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products   = DataHelper::getProducts();
        $categories = DataHelper::getCategories();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = DataHelper::getCategories();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $products = DataHelper::getProducts();
        $image    = null;
        if ($request->hasFile('image')) {
            $file  = $request->file('image');
            $name  = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $name);
            $image = 'uploads/products/' . $name;
        }
        $products[] = [
            'id'          => DataHelper::generateId($products),
            'category'    => $request->category,
            'name'        => $request->name,
            'slug'        => \Illuminate\Support\Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price'       => (int) str_replace(['.', ','], '', $request->price),
            'duration'    => $request->duration,
            'image'       => $image,
            'is_active'   => $request->has('is_active'),
            'created_at'  => now()->toDateString(),
        ];
        DataHelper::saveProducts($products);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $products   = DataHelper::getProducts();
        $product    = null;
        foreach ($products as $p) { if ($p['id'] == $id) { $product = $p; break; } }
        if (!$product) return redirect()->route('admin.produk.index');
        $categories = DataHelper::getCategories();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $products = DataHelper::getProducts();
        foreach ($products as &$p) {
            if ($p['id'] == $id) {
                if ($request->hasFile('image')) {
                    $file  = $request->file('image');
                    $name  = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/products'), $name);
                    $p['image'] = 'uploads/products/' . $name;
                }
                $p['category']    = $request->category;
                $p['name']        = $request->name;
                $p['description'] = $request->description;
                $p['price']       = (int) str_replace(['.', ','], '', $request->price);
                $p['duration']    = $request->duration;
                $p['is_active']   = $request->has('is_active');
                break;
            }
        }
        DataHelper::saveProducts($products);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $products = array_values(array_filter(DataHelper::getProducts(), fn($p) => $p['id'] != $id));
        DataHelper::saveProducts($products);
        return back()->with('success', 'Produk berhasil dihapus.');
    }
}