<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with(['user', 'category', 'comments' => function ($q) {
                $q->where('is_approved', true)->latest();
            }])
            ->firstOrFail();

        // Tăng lượt xem:
        $post->increment('views');

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->latest()->paginate(5); // 5 bài/1 trang

        return view('posts.index', [
            'posts' => $posts,
            'title' => "Bài viết trong danh mục: " . $category->name
        ]);
    }

    public function byTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->latest()->paginate(5);

        return view('posts.index', [
            'posts' => $posts,
            'title' => "Bài viết với tag: " . $tag->name
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'status' => 'published',
            'user_id' => Auth::id(),
            'category_id' => $request->category_id
        ]);

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được lưu!');
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $posts = Post::where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%")
                    ->orWhereHas('tags', function($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('category', function($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    })
                    ->latest()
                    ->paginate(10);

        return view('posts.search', compact('posts', 'keyword'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_draft' => $request->has('save_as_draft')
        ]);

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Đã cập nhật!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        return back()->with('success', 'Đã xoá bài viết.');
    }
}
