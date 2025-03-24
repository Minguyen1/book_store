@extends('adminlte::page')

@section('title', 'Thêm danh mục')

@section('content')
    <div class="container mt-4">
        <h2>Thêm danh mục</h2>
        <form action="{{ route('admin.storeCategory') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name">Tên danh mục:</label>
                <input type="text" name="name" class="form-control">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>          
                @enderror
            </div>

            <button type="submit" class="btn btn-success float-right">Thêm danh mục</button>
        </form>
    </div>
@endsection