@extends('layouts.layout_user')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container container_detail mt-4">
        <div class="div_left">
            <img src="{{ asset('storage/' . $book->image) }}" alt="Sách {{ $book->title }}" width="50%" height="450vh">
        </div>
        <div class="div_right">
            <h1>Sách: {{ $book->title }}</h1>
            <h4 class="fw-normal mt-4">Tác giả: {{ $book->author }}</h4>
            <h4 class="fw-normal mt-3">Thể loại: {{ $book->categories->pluck('name')->join(', ') }}</h4>
            <h4 class="fw-normal mt-3">
                Trạng thái:
                <span class="text-danger" style="font-size: 20px;">
                    {{ $book->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                </span>
            </h4>
            <h3 class="price">{{ number_format($book->price) }} VND</h3>
            <div class="quantity mt-3">
                <button class="btn-decrease" type="button" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <button class="btn-increase" type="button" onclick="increaseQuantity()">+</button>
            </div>
            <form action="{{ route('user.addCart') }}" method="POST" class="d-inline-block mt-4">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" id="hiddenQuantity" name="quantity" value="1">
                <button type="submit" class="btn btn-warning w-100">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
    <div class="container mt-4">
        <h2>Mô tả:</h2>
        <p class="text-wrap" style="max-width: 100%; font-size: 20px;">{{ $book->description }}</p>
    </div>
    <div class="container comments mt-4">
        <h2>Bình luận:</h2>
        @if ($book->comments->count() > 0)
            <div id="commentList" style="max-height: 300px; overflow: hidden;">
                @foreach ($book->comments->take(5) as $comment)
                    <div class="comment border-bottom py-2">
                        <strong>{{ $comment->user->name }}</strong> -
                        <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @endforeach
            </div>

            @if ($book->comments->count() > 5)
                <button id="showAllBtn" class="btn btn-link">Xem tất cả bình luận</button>
                <button id="collapseBtn" class="btn btn-danger"
                    style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: 120px;">
                    Thu gọn
                </button>
            @endif
        @else
            <p>Không có bình luận</p>
        @endif

        @auth
            <form action="{{ route('user.addComment') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div class="mb-3">
                    <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        @else
            <p class="text-muted">Bạn cần <a href="{{ route('form_login') }}">đăng nhập</a> để bình luận.</p>
        @endauth
    </div>
@endsection
