@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- Tiêu đề bài viết --}}
    <h1>{{ $post->title }}</h1>

    {{-- Thông tin phụ: tác giả, ngày đăng, danh mục, lượt xem --}}
    <p class="text-muted">
        Đăng bởi <strong>{{ $post->user->username }}</strong> •
        {{ $post->created_at->format('d/m/Y') }} •
        Danh mục: <strong>{{ $post->category->name ?? 'Không có' }}</strong> •
        👁️ {{ $post->views }} lượt xem
    </p>

    {{-- Ảnh đại diện nếu có --}}
    @if($post->thumbnail)
        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Ảnh bài viết" class="img-fluid my-3 rounded">
    @endif

    {{-- Nội dung bài viết --}}
    <div class="mb-5">
        {!! $post->content !!}
    </div>

    <hr>

    {{-- Phần bình luận --}}
    <h4>Bình luận ({{ $post->comments->count() }})</h4>

    {{-- Form gửi bình luận --}}
    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận..."></textarea>
            </div>
            <button class="btn btn-primary">Gửi bình luận</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
    @endauth

    {{-- Danh sách bình luận --}}
    <ul class="list-unstyled mt-4">
        @forelse ($post->comments as $comment)
            <li class="mb-3 border-bottom pb-2">
                <strong>{{ $comment->user->username }}</strong> –
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                <p class="mb-1">{{ $comment->content }}</p>
            </li>
        @empty
            <p>Chưa có bình luận nào.</p>
        @endforelse
    </ul>
</div>
@endsection
