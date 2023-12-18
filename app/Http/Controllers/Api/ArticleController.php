<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function getAllArticles(Request $request)
    {
        $currentPage = $request->query('page');
        $pageSize = $request->query('size');

        $articleQuery = Article::latest('source_date');

        if ($request->has('keyword')) {
            $keyword = $request->query('keyword');
            $articleQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('source', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        if ($currentPage && $pageSize) {
            $articles = $articleQuery->paginate($pageSize, ['*'], 'page', $currentPage);
        } else {
            $articles = $articleQuery->get();
        }

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
