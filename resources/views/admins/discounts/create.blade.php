@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <h2>Thêm mã giảm giá</h2>
        <form action="" method="POST">
            @csrf

            <div class="mb-3">
                <label for="code">Nhập mã giảm giá:</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                @error('code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="discount_type">Loại giảm giá:</label>
                <select class="form-select" name="discount_type">
                    <option value="percent">Phần trăm</option>
                    <option value="fixed">Số tiền cố định</option>
                </select>
                @error('discount_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="discount_value">Giá trị giảm giá:</label>
                <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value') }}">
                @error('discount_value')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="date" name="start_date" class="form-control">
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="end_date">Ngày kết thúc:</label>
                <input type="date" name="end_date" class="form-control">
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Mô tả:</label>
                <textarea name="description" style="resize: none; height: 160px;" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success float-right">Thêm mã giảm giá</button>
        </form>
    </div>
@endsection