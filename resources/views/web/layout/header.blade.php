<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/web/images/version/tech-logo.png" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/category">Chuyên mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Liên hệ</a>
                    </li>
                </ul>
                <!-- Form tìm kiếm -->
                <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="q" placeholder="Tìm kiếm..." aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form>
                <!-- Đăng nhập và Đăng ký -->
                <div class="navbar-nav">
                    @guest
                        <a href="/login" class="btn btn-primary ml-auto mr-2">Đăng nhập</a>
                        <a href="/register" class="btn btn-outline-primary">Đăng ký</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle ml-auto" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/posts/create"><i class="fa fa-edit"></i> Tạo bài viết</a>
                                <a class="dropdown-item" href="/profile"><i class="fa fa-user"></i> Trang cá nhân</a>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa fa-sign-out"></i> Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->
