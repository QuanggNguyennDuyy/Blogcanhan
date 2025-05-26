@extends('web.layout.master')

@section('content')
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Thông tin cá nhân</h3>
                                        
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        
                                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="text-center mb-4">
                                                @if($user->avatar)
                                                    <img src="{{ asset('image/avatar/' . $user->avatar) }}" 
                                                         alt="{{ $user->name }}" 
                                                         class="rounded-circle" 
                                                         style="width: 150px; height: 150px; object-fit: cover;">
                                                @else
                                                    <i class="fa fa-user-circle fa-5x text-muted"></i>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Tên hiển thị</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="bio">Giới thiệu</label>
                                                <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="current_password">Mật khẩu hiện tại</label>
                                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="new_password">Mật khẩu mới</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm_password">Xác nhận mật khẩu mới</label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Bài viết của tôi</h3>
                                        
                                        @if($posts->isEmpty())
                                            <div class="text-center py-4">
                                                <i class="fa fa-file-text-o fa-3x text-muted"></i>
                                                <p class="mt-2">Bạn chưa có bài viết nào.</p>
                                                <a href="{{ route('posts.create') }}" class="btn btn-primary">Tạo bài viết mới</a>
                                            </div>
                                        @else
                                            <div class="row">
                                                @foreach($posts as $post)
                                                    <div class="col-md-6 mb-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                @if($post->image)
                                                                    <img src="{{ asset('image/post/' . $post->image) }}" 
                                                                         class="img-fluid rounded mb-3" 
                                                                         style="height: 200px; object-fit: cover;">
                                                                @endif
                                                                <h5 class="card-title">{{ $post->title }}</h5>
                                                                <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <small class="text-muted">
                                                                        <i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                                                                    </small>
                                                                    <div>
                                                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                                                            <i class="fa fa-edit"></i> Chỉnh sửa
                                                                        </a>
                                                                        <form action="{{ route('posts.delete', $post->id) }}" method="post" class="d-inline">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                                                                <i class="fa fa-trash"></i> Xóa
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
