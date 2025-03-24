@extends('layouts.layout_user')

@section('title', 'Chỉnh sửa thông tin')

@section('content')
    @if (session('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="update">
            <h2>Chỉnh sửa thông tin</h2>
            <form action="{{ route('user.updateProfile', $user->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Họ và tên:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone">Số điện thoại:</label>
                    <input type="number" name="phone" class="form-control" value="{{ $user->phone }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address">Địa chỉ:</label>
                    <textarea name="description" style="resize: none; height: 100px;" class="form-control"></textarea>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-primary">
                        <a href="{{ route('user.profile') }}" style="text-decoration: none; color: inherit;">Quay lại</a>
                    </button>
                    <button type="submit" class="btn btn-success" style="margin-left: 10px;">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>
    .update{
        max-width: 600px;
        background: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin: auto;
    }

    .update h2{
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>