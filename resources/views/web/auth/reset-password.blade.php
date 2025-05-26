@extends('web.layout.master')

@section('content')
    <section class="section wb mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Đặt lại mật khẩu</h3>
                                <p>Nhập mật khẩu mới cho tài khoản của bạn.</p>
                            </div>
                            @if(session('error'))
                                <div class="col-lg-12">
                                    <div class="alert alert-danger"> {{ session('error') }} </div>
                                </div>
                            @else
                                <div class="col-lg-12">
                                    <form class="form-wrapper" action="{{ route('reset-password') . "?token=" .request()->get('token') }}" method="post">
                                        @csrf
                                        <input type="email"  class="form-control" value="{{ $email }}" disabled>
                                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới">
                                        <input type="password" name="confirm" class="form-control" placeholder="Xác nhận mật khẩu">
                                        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

@endsection
