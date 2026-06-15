<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $articles = array_values(array_filter($articles, fn ($a) => ($a['status'] ?? 'draft') === 'published'));

        usort($articles, fn ($a, $b) => strcmp($b['created_at'], $a['created_at']));

        return view('user.articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $articles = $this->normalizeArticles(DataHelper::getArticles());
        $article = collect($articles)->firstWhere('slug', $slug);

        abort_if(!$article || ($article['status'] ?? 'draft') !== 'published', 404);

        return view('user.articles.show', compact('article'));
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