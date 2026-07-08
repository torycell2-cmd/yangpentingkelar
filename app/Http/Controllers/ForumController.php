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
        Forum::create([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index');
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
        Comment::create([
            'forum_id' => $id,
            'author' => $request->author,
            'comment' => $request->comment,
        ]);

        return back();
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