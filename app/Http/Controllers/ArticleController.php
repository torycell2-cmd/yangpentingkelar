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
        ->when($keyword, function ($query) use ($keyword) {
            return $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%")
                ->orWhere('category', 'LIKE', "%{$keyword}%")
                ->orWhere('author', 'LIKE', "%{$keyword}%");
            });
        })
        ->latest()
        ->get();

        $trendingArticles = Article::where('status', 'approved')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('articles.index', compact('articles', 'trendingArticles', 'keyword'));
    }

    public function pending()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (strtolower(auth()->user()->role) != 'admin') {
            abort(403);
        }

        $articles = Article::where('status', 'pending')
                    ->latest()
                    ->get();

        return view('admin.articles.pending', compact('articles'));
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
        if (!auth()->check()) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }
        $role = strtolower(auth()->user()->role);
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:100',
            'category' => 'required|max:100',
            'content' => 'required',
        ]);

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

        $role = auth()->check()
            ? strtolower(auth()->user()->role)
            : 'guest';

        if ($article->status !== 'approved' && $role !== 'admin') {
            abort(403);
        }

        if ($role === 'siswa') {
            $article->increment('views');
        }

        return view('articles.show', compact('article'));
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        $role = strtolower(auth()->user()->role);

        if ($role != 'admin' && $role != 'guru') {
            abort(403);
        }

        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil dihapus.');
    }

    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $role = strtolower(auth()->user()->role);

        if ($role != 'admin' && $role != 'guru') {
            abort(403);
        }

        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
         if (!auth()->check()) {
            return redirect('/login');
        }

        $role = strtolower(auth()->user()->role);

        if ($role != 'admin' && $role != 'guru') {
            abort(403);
            }
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:100',
            'category' => 'required|max:100',
            'content' => 'required',
        ]);

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
        if (!auth()->check()) {
            return redirect('/login');
        }

        $role = strtolower(auth()->user()->role);

        if ($role != 'admin') {
            abort(403);
        }

        $article = Article::findOrFail($id);

        $article->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Artikel berhasil di-ACC!');
    }
}