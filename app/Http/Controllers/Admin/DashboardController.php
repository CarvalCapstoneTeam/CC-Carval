<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $totalArticles = Article::count();
        $totalNewsletter = Newsletter::count();
        return view('dashboard.index', compact('title', 'totalArticles', 'totalNewsletter'));
    }
}
