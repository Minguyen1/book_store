@extends('layouts.layout_user')

@section('title', 'Xác nhận đơn hàng')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Xác nhận đơn hàng</h2>

        <form action="{{ route('user.createOrder') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4 border rounded bg-white">
                        <h5 class="text-primary mb-3">Thông tin giao hàng</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Họ và tên:</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Số điện thoại:</label>
                            <input type="number" name="phone" class="form-control" value="{{ $user->phone ?? '' }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">Địa chỉ:</label>
                            <textarea name="address" class="form-control" style="resize: none; height: 100px;">{{ $user->address ?? '' }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phương thức thanh toán:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                                <label class="form-check-label">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                            {{-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="vnpay">
                                <label class="form-check-label">VNPay</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="momo">
                                <label class="form-check-label">MoMo</label>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 border rounded bg-white">
                        <h5 class="text-primary mb-3">Sản phẩm trong đơn hàng</h5>
                        @foreach ($cart as $cartItem)
                            @foreach ($cartItem->cart_detail as $detail)
                                <div class="d-flex align-items-center border-bottom py-2">
                                    <div class="me-3">
                                        <img src="{{ asset('storage/' . $detail->book->image) }}" alt="image"
                                            class="rounded" width="80" height="80" style="object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-1 fw-bold">{{ $detail->book->title }}</p>
                                        <p class="text-muted small mb-1">Số lượng: {{ $detail->quantity }}</p>
                                        <p class="text-danger fw-bold">Giá:
                                            {{ number_format($detail->price, 0, ',', '.') }} VNĐ</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="my-3">
                                <label for="note">Ghi chú:</label>
                                <textarea name="note" class="form-control" style="resize: none; height: 120px;"></textarea>
                            </div>
                            <p class="fw-bold mt-3 text-center">
                                Tổng thanh toán: <span class="text-danger">{{ number_format($cartItem->total_price) }}
                                    VND</span>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4 py-2">Xác nhận đơn hàng</button>
            </div>
        </form>
    </div>

@endsection
