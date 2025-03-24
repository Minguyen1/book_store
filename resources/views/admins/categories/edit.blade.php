@extends('adminlte::page')

@section('title', 'Sửa danh mục')

@section('content')
    <div class="container mt-4">
        <h2>Sửa danh mục sản phẩm</h2>
        <form action="{{ route('admin.updateCategory', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">Tên danh mục:</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>          
                @enderror
            </div>

            <button type="submit" class="btn btn-success float-right">Cập nhật</button>
        </form>
    </div>
@endsection