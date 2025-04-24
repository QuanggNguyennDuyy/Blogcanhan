@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Bài viết trong danh mục: <strong>{{ $category->name }}</strong></h3>

    @foreach ($posts as $post)
        <div class="mb-4 border-bottom pb-2">
            <h5><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h5>
            <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection
