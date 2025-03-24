@extends('layouts.layout_user')

@section('title', 'Thông tin cá nhân')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="profile-container">
            <h2>Thông tin cá nhân</h2>
            <div class="profile-item"><strong>Họ và tên:</strong> {{ $user->name }}</div>
            <div class="profile-item"><strong>Email:</strong> {{ $user->email }}</div>
            <div class="profile-item"><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Không có' }}</div>
            <div class="profile-item"><strong>Địa chỉ:</strong> {{ $user->address ?? 'Không có' }}</div>
            <div class="profile-item">
                <strong>Trạng thái:</strong>
                <span class="{{ $user->status == 1 ? 'status-active' : 'status-inactive' }}">
                    {{ $user->status == 1 ? 'Hoạt động' : 'Ngưng hoạt động' }}
                </span>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('user.changePass') }}" class="btn btn-danger btn-lg me-2">Đổi mật khẩu</a>
                <a href="{{ route('user.updateForm', $user->id) }}" class="btn btn-primary btn-lg">Chỉnh sửa thông tin</a>
            </div>
        </div>
    </div>
@endsection

<style>
    .profile-container {
        max-width: 600px;
        background: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin: auto;
    }

    .profile-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .profile-item {
        font-size: 20px;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .profile-item:last-child {
        border-bottom: none;
    }

    .status-active {
        color: green;
        font-weight: bold;
    }

    .status-inactive {
        color: red;
        font-weight: bold;
    }
</style>
