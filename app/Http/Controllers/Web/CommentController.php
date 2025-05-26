<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'update', 'delete']);
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bình luận này.');
        }

        return view('web.comment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bình luận này.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->content = $validated['content'];
        $comment->save();

        return redirect()->back()->with('success', 'Đã cập nhật bình luận thành công!');
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bình luận này.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Đã xóa bình luận thành công!');
    }
}
