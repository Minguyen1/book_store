@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Thông tin cá nhân</h2>
    <table class="table">
        <tr>
            <th>Tên:</th>
            <td>{{ $admin->name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $admin->email }}</td>
        </tr>
    </table>
</div>
@endsection
