<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $title = 'Artikel';
        $articles = Article::all();
        return view('article.index', compact('articles', 'title'));
    }
}
