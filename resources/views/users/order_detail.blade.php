@extends('layouts.layout_user')

@section('title', 'Đơn hàng của tôi')

@section('content')
    <div class="container mt-4">
        <h2>Đơn hàng của tôi</h2>

        @if ($orders->isEmpty())
            <p>Chưa có đơn hàng nào.</p>
        @else
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                            <td>
                                <span class="badge bg-info">{{ $order->status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('users.order_detail', $order->id) }}" class="btn btn-primary">Xem chi
                                    tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
