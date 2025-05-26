@extends('web.layout.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('web/css/auth-form.css') }}">
@endsection

@section('content')
    <section class="section wb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="auth-container">
                        @if(session('error'))
                            <div class="auth-error">
                                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="auth-success">
                                <i class="fa fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif
                        
                        <h2 class="auth-title">Chỉnh sửa bình luận</h2>
                        
                        <form class="form-wrapper" action="{{ route('comment.update', $comment->id) }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label><i class="fa fa-comment"></i> Nội dung bình luận</label>
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4" required>{{ old('content', $comment->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
