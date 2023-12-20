<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $title = 'Newsletter';
        $newsletters = Newsletter::all();
        return view('newsletter.index', compact('newsletters', 'title'));
    }
    public function delete($id)
    {
        $newsletter = Newsletter::where('id', $id)->firstOrFail();
        $newsletter->delete();

        return redirect()->route('newsletter.index')->with('success', 'Newsletter deleted successfully.');
    }
}
