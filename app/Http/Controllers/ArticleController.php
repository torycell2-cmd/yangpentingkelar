<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('query');
        
        $articles = Article::where('status', 'approved')
            ->when($keyword, function($query) use ($keyword) {
                return $query->where('title', 'LIKE', "%{$keyword}%")
                             ->orWhere('content', 'LIKE', "%{$keyword}%");
            })
            ->latest()
            ->get();

        $trendingArticles = Article::where('status', 'approved')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('articles.index', compact('articles', 'trendingArticles', 'keyword'));
    }

    public function create()
{
    // Cek login manual
    if (!auth()->check()) {
        // Tulis session manual
        session()->flash('error', 'Anda harus login terlebih dahulu!');
        
        // Redirect ke login
        return redirect('/login'); 
        }

    // Cek role
        $role = strtolower(auth()->user()->role);
        if ($role !== 'admin' && $role !== 'guru') {
            return redirect()->route('articles.index')->with('error', 'Anda tidak memiliki akses.');
        }

        return view('articles.create');
    }

    public function store(Request $request)
    {
        $role = strtolower(auth()->user()->role);

        if ($role !== 'admin' && $role !== 'guru') {
            return redirect()->route('articles.index')->with('error', 'Anda tidak memiliki akses untuk membuat artikel.');
        }

        Article::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'content' => $request->content,
            'status' => 'pending',
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diajukan! Menunggu persetujuan Admin.');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        
        if ($article->status !== 'approved' && strtolower(auth()->user()->role) !== 'admin') {
            abort(403);
        }

        if (strtolower(auth()->user()->role) === 'siswa') {
            $article->increment('views');
        }

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

    public function approve($id)
    {
        $article = Article::findOrFail($id);
        $article->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Artikel berhasil di-ACC!');
    }
}