@extends('adminlte::page')

@section('title', 'Thêm tài khoản')

@section('content')
    <div class="container mt-4">
        <h2>Thêm tài khoản mới</h2>

        <form action="{{ route('admin.storeAccount') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name">Họ và tên:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input type="password" name="confirm_password" class="form-control">
                @error('confirm_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role">Loại tài khoản</label>
                <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success float-right">Thêm tài khoản</button>
        </form>
    </div>
@endsection