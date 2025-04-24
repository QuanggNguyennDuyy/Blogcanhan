@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛠️ Trang quản trị</h2>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Bài viết</div>
                <div class="card-body">
                    <h4>{{ $totalPosts }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Lượt xem</div>
                <div class="card-body">
                    <h4>{{ $totalViews }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Bình luận chờ duyệt</div>
                <div class="card-body">
                    <h4>{{ $pendingComments }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Người dùng</div>
                <div class="card-body">
                    <h4>{{ $userCount }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
