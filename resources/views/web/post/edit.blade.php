@extends('web.layout.master')

@section('content')
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Chỉnh sửa bài viết</h3>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                <div class="card">
                                    <div class="card-body">
                                        <form class="form-wrapper" action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <h4 class="card-title mb-4">Chỉnh sửa bài viết: {{ $post->title }}</h4>
                                            
                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2"><i class="fa fa-heading"></i> Tiêu đề bài viết</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" placeholder="Nhập tiêu đề bài viết..." required>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2"><i class="fa fa-align-left"></i> Mô tả ngắn</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả ngắn cho bài viết..." required>{{ $post->description }}</textarea>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2"><i class="fa fa-file-text"></i> Nội dung bài viết</label>
                                                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Nhập nội dung bài viết..." required>{{ $post->content }}</textarea>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2"><i class="fa fa-folder"></i> Chuyên mục</label>
                                                <select class="form-control" id="category_id" name="category_id" required>
                                                    <option value="">Chọn chuyên mục</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label class="d-block mb-2"><i class="fa fa-image"></i> Hình ảnh đại diện</label>
                                                <input type="file" class="form-control-file" id="image" name="image">
                                                <small class="form-text text-muted">Hỗ trợ định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB</small>
                                                @if($post->image)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('image/post/' . $post->image) }}" alt="{{ $post->title }}" style="max-width: 200px;">
                                                        <small class="form-text text-muted">Hình ảnh hiện tại</small>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <i class="fa fa-save"></i> Lưu thay đổi
                                                </button>
                                                <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger btn-lg" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                                    <i class="fa fa-trash"></i> Xóa bài viết
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
