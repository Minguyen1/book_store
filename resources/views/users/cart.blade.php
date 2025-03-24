@extends('layouts.layout_user')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="container mt-4">
        @auth
            @if ($cartEmpty)
                <div class="alert alert-info text-center">
                    🛒 Không có sản phẩm nào trong giỏ hàng! <br>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
                </div>
            @else
                <h2>Đây là giỏ hàng của bạn</h2>
                @foreach ($carts as $cart)
                    <table class="table mt-4">
                        <thead class="table-dark">
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề sách</th>
                                <th>Tác giả</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th style="text-align: center;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($cart->cart_detail as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->book->title }}</td>
                                    <td>{{ $item->book->author }}</td>
                                    <td>{{ number_format($item->book->price) }} VND</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price) }} VND</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('user.detailProduct', $item->book->id) }}" class="btn btn-primary">Xem
                                            chi tiết</a>
                                        <form action="{{ route('user.deleteCartDetail', $item->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có muốn xóa sản phẩm này?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td style="font-size: 20px; font-weight: bold;">Tổng tiền</td>
                                <td colspan="2"></td>
                                <td>{{ number_format($cart->total_price) }} VND</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('user.order') }}" style="color: white; text-decoration: none;" class="btn btn-success">Đặt hàng</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            @endif
        @endauth
    </div>
@endsection
