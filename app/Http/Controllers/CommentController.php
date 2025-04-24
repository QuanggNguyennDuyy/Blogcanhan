<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|min:3'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'content' => $request->content,
            'is_approved' => false, // cần admin duyệt
            'status' => 'pending',
        ]);

        return back()->with('success', 'Bình luận của bạn đang chờ duyệt.');
    }

    public function index()
    {
        $comments = Comment::where('status', 'pending')->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'approved';
        $comment->save();

        return back()->with('success', 'Bình luận đã được duyệt.');
    }
}
