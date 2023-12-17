<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $title = 'Artikel';
        $articles = Article::all();
        return view('article.index', compact('articles', 'title'));
    }
    public function create()
    {
        $title = 'Tambah Artikel';
        return view('article.create', compact('title'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'news_writer' => 'required',
            'source' => 'required',
            'source_date' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|file|mimes:png,jpg,jpeg',
            'content' => 'required',
        ]);

        $uniqueSlug = $this->makeUniqueSlug($request->slug);

        $uploadedFile = $request->file('thumbnail');
        $originalName = $uploadedFile->getClientOriginalName();
        $thumbnailName = "$uniqueSlug" . '-' . $originalName;
        $thumbnailPath = $uploadedFile->storeAs('public/thumbnail', $thumbnailName);

        $content = $request->content;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "articles/$uniqueSlug" . time() . $k . '.png';
            Storage::put("public/$image_name", $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', env('APP_URL') . Storage::url($image_name));
        }

        $content = $dom->saveHTML();

        $summernote = new Article();

        $summernote->title = $request->title;
        $summernote->slug = $uniqueSlug;
        $summernote->news_writer = $request->news_writer;
        $summernote->source = $request->source;
        $summernote->source_date = $request->source_date;
        $summernote->thumbnail = $thumbnailPath;
        $summernote->description = $request->description;
        $summernote->content = $content;

        $summernote->save();

        return redirect()->route('article.index')->with('success', 'Article berhasil ditambahkan.');
    }
    public function show($slug)
    {
        $title = 'Detail Artikel';
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('article.show', compact('article', 'title'));
    }

    public function edit($slug)
    {
        $title = 'Edit Artikel';
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('article.edit', compact('article', 'title'));
    }
    private function makeUniqueSlug($slug, $currentSlug = null)
    {
        $uniqueSlug = $slug;
        $counter = 2;

        while (Article::where('slug', $uniqueSlug)->whereNot('slug', $currentSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $uniqueSlug;
    }
}
