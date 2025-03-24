@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <h2>Tất cả đơn hàng</h2>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($order as $item)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->receiver_name ?? $item->user->name }}</td>
                        <td>{{ $item->receiver_phone ?? $item->user->phone }}</td>
                        <td>{{ $item->receiver_address ?? $item->user->address }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('admin.orders.detail', $item->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
