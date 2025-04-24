@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Kết quả tìm kiếm cho: <em>{{ $keyword }}</em></h3>

    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="mb-4 border-bottom pb-2">
                <h5><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h5>
                <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                <small class="text-muted">Đăng ngày: {{ $post->created_at->format('d/m/Y') }}</small>
            </div>
        @endforeach

        {{ $posts->links() }}
    @else
        <p>Không tìm thấy bài viết phù hợp.</p>
    @endif
</div>
@endsection
