<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post', 'user')->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approved = true;
        $comment->save();

        return back()->with('success', 'Đã duyệt bình luận.');
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return back()->with('success', 'Đã xoá bình luận.');
    }
}
