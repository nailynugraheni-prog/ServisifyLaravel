<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = $this->normalizeArticles(DataHelper::getArticles());
        usort($articles, fn ($a, $b) => strcmp($b['created_at'], $a['created_at']));

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = DataHelper::defaultArticleCategories();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $id = DataHelper::generateId($articles);

        $slug = $this->uniqueSlug(Str::slug($request->title), $articles);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request->file('image'), $slug);
        }

        $user = session('user', []);
        $authorName = $user['name'] ?? 'Admin Servisify';

        $articles[] = [
            'id' => $id,
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'author_name' => $authorName,
            'status' => $request->status,
            'created_at' => date('Y-m-d'),
        ];

        DataHelper::saveArticles($articles);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $article = collect($articles)->firstWhere('id', (int) $id);

        abort_if(!$article, 404);

        $categories = DataHelper::defaultArticleCategories();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $index = collect($articles)->search(fn ($item) => (int) $item['id'] === (int) $id);

        abort_if($index === false, 404);

        $current = $articles[$index];

        $slug = Str::slug($request->title);
        $slug = $this->uniqueSlug($slug, $articles, (int) $id);

        $imagePath = $current['image'] ?? null;
        if ($request->hasFile('image')) {
            if (!empty($imagePath) && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
            $imagePath = $this->uploadImage($request->file('image'), $slug);
        }

        $articles[$index] = [
            'id' => (int) $current['id'],
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'author_name' => $current['author_name'] ?? 'Admin Servisify',
            'status' => $request->status,
            'created_at' => $current['created_at'] ?? date('Y-m-d'),
        ];

        DataHelper::saveArticles($articles);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:draft,published'],
        ]);

        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $index = collect($articles)->search(fn ($item) => (int) $item['id'] === (int) $id);

        abort_if($index === false, 404);

        $articles[$index]['status'] = $request->status;

        DataHelper::saveArticles($articles);

        return back()->with('success', 'Status artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $index = collect($articles)->search(fn ($item) => (int) $item['id'] === (int) $id);

        abort_if($index === false, 404);

        $article = $articles[$index];

        if (!empty($article['image']) && File::exists(public_path($article['image']))) {
            File::delete(public_path($article['image']));
        }

        unset($articles[$index]);
        $articles = array_values($articles);

        DataHelper::saveArticles($articles);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function uniqueSlug(string $slug, array $articles, ?int $ignoreId = null): string
    {
        $base = $slug ?: 'artikel-baru';
        $final = $base;
        $i = 2;

        while (collect($articles)->contains(function ($item) use ($final, $ignoreId) {
            $sameSlug = ($item['slug'] ?? null) === $final;
            $sameId = $ignoreId !== null && (int) ($item['id'] ?? 0) === $ignoreId;
            return $sameSlug && !$sameId;
        })) {
            $final = $base . '-' . $i;
            $i++;
        }

        return $final;
    }

    private function uploadImage($file, string $slug): string
    {
        $dir = public_path('uploads/articles');

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = time() . '_' . $slug . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/articles/' . $filename;
    }

    private function normalizeArticles(array $articles): array
    {
        return array_map(function ($article) {
            if (!isset($article['status'])) {
                $article['status'] = !empty($article['is_published']) ? 'published' : 'draft';
            }
            unset($article['is_published']);
            return $article;
        }, $articles);
    }
}