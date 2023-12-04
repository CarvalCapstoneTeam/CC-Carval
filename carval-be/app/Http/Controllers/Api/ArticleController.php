<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function getAllArticles()
    {
        $article = Article::all();
        return response()->json([
            'error' => false,
            'message' => 'Articles fetched successfully',
            'listArticle' => $article
        ]);
    }
}
