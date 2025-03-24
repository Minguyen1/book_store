@extends('adminlte::page')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-4">
        <h2>Tất cả danh mục sách</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if ($category->status)
                                Hoạt động
                            @else
                                Ngưng hoạt động
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.editCategory', $category->id) }}" class="btn btn-warning">Sửa</a>
                            @if ($category->status)
                                <form action="{{ route('admin.hiddenCategory', $category->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có muốn ẩn danh mục này?')">Ẩn</button>
                                </form>
                            @else
                                <form action="{{ route('admin.activeCategory', $category->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Bạn có muốn hiển thị danh mục này?')">Hiện</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
