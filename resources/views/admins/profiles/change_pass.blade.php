@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <h2>Đổi mật khẩu</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.update-password') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="password">Mật khẩu hiện tại</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control">
            @error('new_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="confirm_password">Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password" class="form-control">
            @error('confirm_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Cập nhật mật khẩu</button>
    </form>
</div>
@endsection
