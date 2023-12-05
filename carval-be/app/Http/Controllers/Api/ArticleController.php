<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function getAllArticles()
    {
        $articles = Article::all();
        if (!$articles) {
            return response()->json([
                'error' => true,
                'message' => 'Articles not found'
            ], 404);
        }
        return response()->json([
            'error' => false,
            'message' => 'Articles fetched successfully',
            'listArticle' => $articles
        ]);
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        if (!$article) {
            return response()->json([
                'error' => true,
                'message' => 'Article not found'
            ], 404);
        }
        return response()->json([
            'error' => false,
            'message' => 'Show article successfully',
            'showArticle' => $article
        ]);
    }
}
