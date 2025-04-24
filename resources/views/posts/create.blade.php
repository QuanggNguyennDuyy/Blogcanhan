@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Tạo bài viết mới</h1>

        {{-- Hiển thị lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ôi!</strong> Có lỗi xảy ra:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-input w-full rounded-md" required value="{{ old('title') }}">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                <select name="category_id" id="category_id" class="form-select w-full rounded-md" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-input w-full rounded-md" accept="image/*">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Nội dung</label>
                <textarea name="content" id="content" rows="10" class="form-textarea w-full rounded-md" required>{{ old('content') }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">Hủy</a>
                <button type="submit" class="btn btn-primary">Đăng bài</button>
            </div>
        </form>
    </div>
</div>
@endsection
