@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Lịch sử đơn hàng</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Người đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                        <td>
                            @if ($order->status == 'Hoàn thành')
                                <span class="badge bg-success">{{ $order->status }}</span>
                            @elseif($order->status == 'Đã hủy')
                                <span class="badge bg-danger">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
