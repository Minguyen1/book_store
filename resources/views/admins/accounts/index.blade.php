@extends('adminlte::page')

@section('title', 'Tất cả tài khoản')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-4">
        <h2>Tất cả tài khoản</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Loại tài khoản</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->email }}</td>
                        <td>
                            @if ($account->phone)
                                {{ $account->phone }}
                            @else
                                Không có
                            @endif
                        </td>
                        <td>
                            @if ($account->address)
                                {{ $account->address }}
                            @else
                                Không có
                            @endif
                        </td>
                        <td>{{ $account->role }}</td>
                        <td>
                            @if ($account->status == 1)
                                Hoạt động
                            @else
                                Ngưng hoạt động
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.editAccount', $account->id) }}" class="btn btn-warning">Sửa</a>
                            @if ($account->status == 1)
                                <form action="{{ route('admin.hiddenAccount', $account->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?')">Khóa</button>
                                </form>
                            @else
                                <form action="{{ route('admin.activeAccount', $account->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này?')">Mở khóa</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
