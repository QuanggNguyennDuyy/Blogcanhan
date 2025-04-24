@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Chào mừng đến với Blog Cá Nhân</h1>
        <p class="text-gray-600">Nơi chia sẻ kiến thức và kinh nghiệm.</p>
    </div>

    <!-- Bài viết mới nhất -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Bài viết mới nhất</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if($post->thumbnail)
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Không có ảnh</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <div class="text-sm text-gray-500 mb-4">
                            <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $post->category->name }}</span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Đọc thêm →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Chưa có bài viết nào.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Phân trang -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
