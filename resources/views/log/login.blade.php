@extends('layouts.layout_user')

@section('title', 'Login')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container container_login mt-4">
        <h2 class="title">Đăng nhập</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="mb-2">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mb-5">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="mb-2">Password:</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <div class="text-danger mb-5">{{ $message }}</div>
                @enderror
            </div>

            <a class="forget_pass" href="#">Quên mật khẩu</a>
            <a class="register" href="{{ route('form_register') }}">Đăng ký</a>
            <button class="login" type="submit">Đăng nhập</button>
        </form>
    </div>
@endsection
