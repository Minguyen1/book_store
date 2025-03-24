@extends('layouts.layout_user')

@section('title', 'Đổi mật khẩu')

@section('content')
    @if (session('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="chage">
            <h2>Đổi mật khẩu</h2>
            <form action="{{ route('user.chagePass') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="password">Nhập mật khẩu của bạn:</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="new_password">Nhập mật khẩu mới:</label>
                    <input type="password" name="new_password" class="form-control">
                    @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirm_password">Xác nhận lại mật khẩu mới:</label>
                    <input type="password" name="confirm_password" class="form-control">
                    @error('confirm_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-primary">
                        <a href="{{ route('user.profile') }}" style="text-decoration: none; color: inherit;">Quay lại</a>
                    </button>
                    <button type="submit" class="btn btn-success" style="margin-left: 10px;">Cập nhật mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>
    .chage {
        max-width: 600px;
        background: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin: auto;
    }

    .chage h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>
