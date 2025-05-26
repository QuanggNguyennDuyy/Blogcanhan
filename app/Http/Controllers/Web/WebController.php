<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'showProfile',
            'updateProfile',
            'createPost',
            'storePost',
            'editPost',
            'updatePost',
            'deletePost'
        ]);
    }

    public function home()
    {
        $highlight = Post::where('highlight_post', 1)
            ->take(3)->get();
        $new = Post::where('new_post', 1)->take(10)->get();
        return view('web.home', compact('highlight', 'new'));
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return redirect()->back();
        }

        // Tìm kiếm trong title và content
        $posts = Post::where(function($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
              ->orWhere('content', 'like', '%' . $query . '%');
        })->paginate(6);

        $highlight = Post::where('highlight_post', 1)
            ->take(3)->get();
        $categories = Category::all();

        return view('web.search', compact('query', 'posts', 'highlight', 'categories'));
    }

    public function categorySlug($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(6);
        $highlight = Post::where('highlight_post', 1)
            ->take(3)->get();
        $categories = Category::all();

        return view('web.category', compact('category', 'posts', 'highlight', 'categories'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->update([
            'view_counts' => $post->view_counts + 1
        ]);

        $relate = Post::where('category_id', $post->category_id)->take(2)->inRandomOrder()->get();

        $highlight = Post::where('highlight_post', 1)
            ->take(3)->get();

        return view('web.post', compact('post', 'relate', 'highlight'));
    }

    public function comment(Request $request, $id)
    {
        Comment::create([
            'content' => $request->get('content'),
            'user_id' => Auth::id(),
            'post_id' => $id
        ]);
        return redirect()->back();
    }

    public function category()
    {
        $posts = Post::paginate(1);
        $categories = Category::all();
        return view('web.category', compact('posts', 'categories'));
    }

    public function showProfile()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('web.profile.index', compact('user', 'posts'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:500',
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'Mật khẩu hiện tại không chính xác.',
            ])->withInput();
        }

        // Cập nhật thông tin
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;
        $user->password = Hash::make($validated['new_password']);

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function createPost()
    {
        $categories = Category::all();
        return view('web.post.create', compact('categories'));
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->content = $validated['content'];
        $post->category_id = $validated['category_id'];
        $post->user_id = Auth::id();
        $post->slug = Str::slug($validated['title']);
        $post->highlight_post = 0;
        $post->new_post = 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/post'), $filename);
            $post->image = $filename;
        }

        $post->save();

        return redirect('/')->with('success', 'Đã tạo bài viết thành công!');
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài viết này.');
        }

        return view('web.post.edit', compact('post', 'categories'));
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài viết này.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->content = $validated['content'];
        $post->category_id = $validated['category_id'];
        $post->slug = Str::slug($validated['title']);
        $post->highlight_post = $post->highlight_post;
        $post->new_post = $post->new_post;

        if ($request->hasFile('image')) {
            if ($post->image) {
                @unlink(public_path('image/post/' . $post->image));
            }
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/post'), $filename);
            $post->image = $filename;
        }

        $post->save();

        return redirect('/')->with('success', 'Đã cập nhật bài viết thành công!');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bài viết này.');
        }

        if ($post->image) {
            @unlink(public_path('image/post/' . $post->image));
        }

        $post->delete();

        return redirect('/')->with('success', 'Đã xóa bài viết thành công!');
    }
}
