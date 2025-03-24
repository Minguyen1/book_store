@extends('layouts.layout_user')

@section('title', 'Trang chủ')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid container_banner">
        <div class="chevron_left">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <a href="#">
            <img class="banner" src="{{ asset('storage/banners/banner_1.png') }}" alt="Banner"
                data-images='@json([
                    asset('storage/banners/banner_1.jpg'),
                    asset('storage/banners/banner_2.png'),
                    asset('storage/banners/banner_3.jpg')
                ])'>
        </a>
        <div class="chevron_right">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
    <div class="container mt-5">
        {{-- Danh sách sản phẩm --}}
        <h2>Sản phẩm nổi bật</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
            @foreach ($books as $book)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}"
                            style="height: 280px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ number_format($book->price, 0, ',', '.') }} VND</p>

                            <div class="d-flex flex-column gap-2">
                                <form action="{{ route('user.addCart') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <input type="hidden" id="hiddenQuantity" name="quantity" value="1">
                                    <button type="submit" class="btn btn-warning w-100">Thêm vào giỏ hàng</button>
                                </form>

                                <a href="{{ route('user.detailProduct', $book->id) }}" class="btn btn-primary w-100">Xem chi tiết</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $books->links() }}
        </div>
    </div>
@endsection
