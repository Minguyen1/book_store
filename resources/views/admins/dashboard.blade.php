@extends('adminlte::page')

@section('title', 'Trang Quản Trị')

@section('content_header')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Dashboard</h1>
@endsection

@section('content')
    <p>Chào mừng bạn đến với trang quản trị!</p>
@endsection
