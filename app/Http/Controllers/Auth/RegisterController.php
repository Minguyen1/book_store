<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|max:255|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.max' => 'Tên quá dài',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu quá ngắn',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không trùng khớp'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('form_login')->with('success', 'Đăng ký tài khoản thành công');
    }
}
