@extends('adminlte::page')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="container mt-4" style="height: 100vh">
        <h2>Thêm sản phẩm</h2>
        <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title">Tiêu đề sách:</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author">Tác giả:</label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                @error('author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author">Thể loại:</label>
                <select name="category">
                    <option value="">Chọn thể loại</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image">Hình ảnh:</label>
                <input type="file" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price">Giá:</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity">Số lượng:</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}">
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Mô tả:</label>
                <textarea name="description" style="resize: none; height: 160px;" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success float-right">Thêm sản phẩm</button>
        </form>
    </div>
@endsection
