@extends('layouts.layout_user')

@section('title', 'Đơn hàng')

@section('content')
    <div class="container mt-4">
        <h2>Lịch sử đơn hàng</h2>

        @if ($historyOrders->isEmpty())
            <p>Không có đơn hàng nào trong lịch sử.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Ngày đặt</th>
                        <th>Tổng giá trị</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historyOrders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                            <td>
                                <span class="badge {{ $order->status == 'Đã hoàn thành' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('users.order_detail', $order->id) }}" class="btn btn-info btn-sm">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
