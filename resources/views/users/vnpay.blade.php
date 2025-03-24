@extends('layouts.layout_user')

@section('title', 'Thanh toán VNPAY')

@section('content')
    <div class="container mt-5">
        <h2>Thanh toán VNPAY</h2>
        <form action="{{ route('vnpay.payment') }}" method="post">
            @csrf
            <label>Nhập số tiền:</label>
            <input type="number" name="amount" required>
            <button type="submit">Thanh toán với VNPAY</button>
        </form>        
    </div>
@endsection
