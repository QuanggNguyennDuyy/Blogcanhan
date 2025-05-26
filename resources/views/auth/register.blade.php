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
                        
                        <h2 class="auth-title">Đăng ký tài khoản</h2>
                        
                        <form class="form-wrapper" action="{{ route('web.auth.register') }}" method="post">
                            @csrf
                            
                            <div class="form-group">
                                <label><i class="fa fa-user"></i> Tên đầy đủ</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Nhập tên đầy đủ">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label><i class="fa fa-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Nhập địa chỉ email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label><i class="fa fa-lock"></i> Mật khẩu</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Nhập mật khẩu">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label><i class="fa fa-lock"></i> Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirmation" class="form-control" required placeholder="Nhập lại mật khẩu">
                            </div>

                            <button type="submit" class="auth-btn">
                                <i class="fa fa-user-plus"></i> Đăng ký tài khoản
                            </button>

                            <div class="auth-link">
                                <p>Đã có tài khoản? <a href="/login">Đăng nhập ngay</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
