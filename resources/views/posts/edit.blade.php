@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Chỉnh sửa bài viết</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Ôi!</strong> Có lỗi xảy ra:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-input w-full rounded-md" required value="{{ old('title', $post->title) }}">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                <select name="category_id" id="category_id" class="form-select w-full rounded-md" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $post->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                @if($post->thumbnail)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Current thumbnail" class="h-32 w-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="thumbnail" id="thumbnail" class="form-input w-full rounded-md" accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi ảnh</p>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Nội dung</label>
                <textarea name="content" id="content" rows="10" class="form-textarea w-full rounded-md" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">Hủy</a>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection
