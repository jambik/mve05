<?php

namespace App\Http\Controllers;

use App\News;
use App\Page;

class NewsController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->get();
        $page = Page::findBySlug('news');

        return view('news.index', compact('news', 'page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = News::findOrFail($id);

        return view('news.show', compact('item'));
    }
}
