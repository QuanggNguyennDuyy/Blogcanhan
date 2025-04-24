<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\BlogController;

// Trang welcome (khách chưa đăng nhập)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trang bài viết chi tiết, tìm kiếm, theo danh mục/tag (ngoài auth)
Route::get('/bai-viet/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/tim-kiem', [PostController::class, 'search'])->name('posts.search');
Route::get('/danh-muc/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{slug}', [TagController::class, 'show'])->name('tag.show');

// Bình luận bài viết (chỉ người đăng nhập)
Route::post('/bai-viet/{post}/binh-luan', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// Các route yêu cầu đăng nhập
Route::middleware(['auth'])->group(function () {
    // Dashboard quản trị
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý bài viết (CRUD)
    Route::resource('posts', PostController::class)->except(['show']);

    // Quản lý bình luận (người dùng)
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::patch('/comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Quản lý profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
