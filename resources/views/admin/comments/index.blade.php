@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Bình luận đang chờ duyệt</h3>

    @foreach ($comments as $comment)
        <div class="border p-3 mb-3">
            <p><strong>{{ $comment->user->name }}</strong> bình luận bài:
               <a href="{{ route('posts.show', $comment->post_id) }}">{{ $comment->post->title }}</a></p>
            <p>{{ $comment->content }}</p>
            <form action="{{ route('comments.approve', $comment->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Duyệt</button>
            </form>
        </div>
    @endforeach

    {{ $comments->links() }}
</div>
@endsection
