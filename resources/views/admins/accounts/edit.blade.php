@extends('adminlte::page')

@section('title', 'Sửa tài khoản')

@section('content')
    <div class="container mt-4">
        <h2>Cập nhật tài khoản</h2>

        <form action="{{ route('admin.updateAccount', $account->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">Họ và tên:</label>
                <input type="text" name="name" class="form-control" value="{{ $account->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $account->email }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone">Số điện thoại:</label>
                <input type="number" name="phone" class="form-control" value="{{ $account->phone }}">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" class="form-control" value="{{ $account->address }}">
                @error('address')
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
            <button type="submit" class="btn btn-success float-right">Cập nhật</button>
        </form>
    </div>
@endsection