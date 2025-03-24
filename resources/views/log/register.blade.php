@extends('layouts.layout_user')

@section('title', 'Register')

@section('content')
    <div class="container container_register mt-4">
        <h2 class="title mt-3">Đăng ký</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="mb-2">Họ và tên:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger mb-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="mb-2">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mb-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="mb-2">Mật khẩu</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <div class="text-danger mb-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="mb-2">Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" class="form-control">
                @error('confirm_password')
                    <div class="text-danger mb-4">{{ $message }}</div>
                @enderror
            </div>

            <a class="login" href="{{ route('form_login') }}">Đã có tài khoản</a>
            <input type="reset" class="reset" value="Nhập lại">
            <button class="register" type="submit">Đăng ký</button>
        </form>
    </div>
@endsection