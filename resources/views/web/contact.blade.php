@extends('web.layout.master')

@section('content')
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            @if(session('success'))
                                <div class="col-lg-12">
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-5">
                                <h4>Về chúng tôi</h4>
                                <p>Blog Cá Nhân là nơi chia sẻ những câu chuyện, suy nghĩ và trải nghiệm từ các tác giả độc lập trên thế giới.</p>

                                <h4>Chúng tôi hỗ trợ gì?</h4>
                                <p>Chúng tôi giúp bạn kết nối với cộng đồng người viết blog, chia sẻ kiến thức và trải nghiệm.</p>

                                <h4>Câu hỏi trước khi liên hệ</h4>
                                <p>Vui lòng đọc kỹ các điều khoản và chính sách của chúng tôi trước khi liên hệ.</p>
                            </div>
                            <div class="col-lg-7">
                                <form class="form-wrapper" action="{{ route('contact.store') }}" method="post">
                                    @csrf
                                    
                                    <div class="form-group mb-3">
                                        <label for="name">Tên của bạn</label>
                                        <input type="text" name="name" class="form-control" id="name" required placeholder="Nhập tên của bạn">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" name="address" class="form-control" id="address" required placeholder="Nhập địa chỉ">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" id="phone" required placeholder="Nhập số điện thoại">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="subject">Chủ đề</label>
                                        <input type="text" name="subject" class="form-control" id="subject" required placeholder="Nhập chủ đề">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="message">Nội dung</label>
                                        <textarea name="message" class="form-control" id="message" rows="5" required placeholder="Nhập nội dung"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-envelope"></i> Gửi liên hệ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
