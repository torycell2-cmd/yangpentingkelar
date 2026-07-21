<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Comment;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::latest()->get();

        $totalForum = Forum::count();

        $totalComment = Comment::count();

        return view(
            'forum.index',
            compact(
                'forums',
                'totalForum',
                'totalComment'
            )
        );
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
    // Validasi input dulu
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

    // Simpan ke database dengan menambahkan 'author'
        \App\Models\Forum::create([
            'title' => $request->title,
            'content' => $request->content,
        // Ini kuncinya: ambil ID user yang sedang login
            'author' => auth()->user()->id, 
        ]);

        return redirect()->route('forum.index')->with('success', 'Forum berhasil dibuat!');
    }

    public function show($id)
    {
        $forum = Forum::with('comments')->findOrFail($id);

        return view('forum.show', compact('forum'));
    }

    public function edit($id)
    {
        $forum = Forum::findOrFail($id);

        return view('forum.edit', compact('forum'));
    }

    public function storeComment(Request $request, $id)
    {
    // Validasi
        $request->validate([
            'comment' => 'required',
        ]);

    // Simpan komentar
        // Simpan komentar
        \App\Models\Comment::create([
            'forum_id' => $id,            
            'comment'  => $request->comment,
            'author'   => auth()->user()->id, 
            'user_id'  => auth()->user()->id, // <--- TAMBAHKAN INI

        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }   

    public function editComment($id)
    {
        $comment = Comment::findOrFail($id);

        /*
         $forum->update([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
        ]);
        */

        return view('forum.edit-comment', compact('comment'));
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $comment->update([
            'author' => $request->author,
            'comment' => $request->comment,
        ]);

        return redirect()->route('forum.show', $comment->forum_id);
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);

        $forumId = $comment->forum_id;

        $comment->delete();

        return redirect()->route('forum.show', $forumId);
    }

    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);

        $forum->delete();

        return redirect()->route('forum.index');
    }

    public function update(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);

        $forum->update([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index');
    }
}