@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

        <div class="card p-3">
            <h5><strong>Người nhận:</strong> {{ $order->receiver_name ?? $order->user->name }}</h5>
            <h5><strong>Số điện thoại:</strong> {{ $order->receiver_phone ?? $order->user->phone }}</h5>
            <h5><strong>Địa chỉ:</strong> {{ $order->receiver_address ?? $order->user->address }}</h5>
            <h5><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</h5>
            <h5><strong>Trạng thái:</strong>
                <span class="badge bg-info">{{ $order->status }}</span>
            </h5>
            <h5><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</h5>
        </div>

        <h4 class="mt-4">Danh sách sản phẩm</h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->order_details as $key => $detail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $detail->book->title }}</td>
                        <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-info">
                    <td colspan="4" class="text-end"><strong>Tổng giá trị đơn hàng:</strong></td>
                    <td><strong>{{ number_format($order->total_price, 0, ',', '.') }} VND</strong></td>
                </tr>
            </tfoot>
        </table>

        <h4 class="mt-4">Cập nhật trạng thái đơn hàng</h4>
        <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <select name="status" class="form-control">
                    <option value="Chờ xử lý" {{ $order->status == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="Đang xử lý" {{ $order->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="Đang giao hàng" {{ $order->status == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao
                        hàng</option>
                    <option value="Hoàn thành" {{ $order->status == 'Hoàn thành' ? 'selected' : '' }}>Đã hoàn thành
                    </option>
                    <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>

        <a href="{{ route('admin.orders') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection