<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalPosts' => Post::count(),
            'totalViews' => Post::sum('views'),
            'pendingComments' => Comment::where('approved', false)->count(),
            'userCount' => User::count()
        ]);
    }
}