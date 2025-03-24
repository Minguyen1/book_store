@extends('adminlte::page')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-4">
        <h2>Tất cả sản phẩm</h2>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề sách</th>
                    <th>Tác giả</th>
                    <th>Thể loại</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @foreach ($book->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td><img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                                style="100px; height: 100px;"></td>
                        <td>{{ number_format($book->price) }} VNĐ</td>
                        <td>{{ $book->quantity }}</td>
                        <td>{{ Str::limit($book->description, 20, '...') }}</td>
                        <td>
                            @if ($book->status)
                                Hoạt động
                            @else
                                Ngưng hoạt động
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.editProduct', $book->id) }}" class="btn btn-warning" style="margin-right: 5px;">Sửa</a>
                                <form action="{{ route('admin.deleteProduct', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
