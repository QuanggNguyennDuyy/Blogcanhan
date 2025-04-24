<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->latest()
            ->paginate(9);

        $categories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(8)
            ->get();

        return view('blog.index', compact('posts', 'categories'));
    }
}
