<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('query');
        
        $articles = Article::where('title', 'LIKE', "%{$keyword}%")->get();
        
        return view('articles.search_result', compact('articles', 'keyword'));
    }

    public function index()
    {
        $articles = Article::latest()->get();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        Article::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'content' => $request->content,
        ]);

        return redirect()->route('articles.index');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }


    public function destroy($id)
    {
    $article = Article::findOrFail($id);

    $article->delete();

    return redirect()->route('articles.index');
    }


    public function edit($id)
    {
    $article = Article::findOrFail($id);

    return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    $article->update([
        'title' => $request->title,
        'author' => $request->author,
        'category' => $request->category,
        'content' => $request->content,
    ]);

    return redirect()->route('articles.index');
}
}