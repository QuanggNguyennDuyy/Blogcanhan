@extends('web.layout.master')

@section('content')
    <section class="section wb mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Quên mật khẩu</h3>
                                <p>Nhập địa chỉ email của bạn để nhận hướng dẫn đặt lại mật khẩu.</p>
                            </div>
                            @if(session('error'))
                                <div class="col-lg-12">
                                    <div class="alert alert-danger"> {{ session('error') }} </div>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <form class="form-wrapper" action="{{ route('send-mail') }}" method="post">
                                    @csrf
                                    <input type="email" name="email" class="form-control" placeholder="Địa chỉ email">
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

@endsection
