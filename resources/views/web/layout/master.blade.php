<!DOCTYPE html>
<html lang="vi">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Blog Cá Nhân</title>
<meta name="keywords" content="blog, viết blog, chia sẻ, cá nhân">
<meta name="description" content="Blog cá nhân - nơi chia sẻ những câu chuyện và suy nghĩ của bạn">
<meta name="author" content="">

@include('web.layout.style')
@stack('styles')
</head>
<body>

<div id="wrapper">
    @include('web.layout.header')

    @yield('content')

    <div class="dmtop">Scroll to Top</div>

    @include('web.layout.footer')

</div><!-- end wrapper -->

@include('web.layout.script')
@stack('scripts')
</body>
</html>
