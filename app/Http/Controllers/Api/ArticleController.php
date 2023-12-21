<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Get All Articles
     * 
     * This endpoint is used to get all existing articles.
     */
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

        foreach ($articles as $article) {
            $article->thumbnail = env('APP_URL') . '/' . str_replace('public/', 'storage/', $article->thumbnail);
        }
        
        return response()->json([
            'error' => false,
            'message' => 'Articles fetched successfully',
            'listArticle' => $articles
        ]);
    }

    /**
     * Get Detail Article
     * 
     * This endpoint is used to get detail of one of the of one of the article.
     * 
     * @urlParam slug string required
     * Slug is the unique identifier of the article and can be obtained from the Get All Articles response.<br>
     * Example: jangan-terjebak-begini-ciri-ciri-tawaran-kerja-yang-ujungnya-penipuan
     */
    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $article->thumbnail = env('APP_URL') . '/' .str_replace('public/', 'storage/', $article->thumbnail);
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
