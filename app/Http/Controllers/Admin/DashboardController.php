<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $totalArticles = Article::count();
        return view('dashboard.index', compact('title', 'totalArticles'));
    }
}
