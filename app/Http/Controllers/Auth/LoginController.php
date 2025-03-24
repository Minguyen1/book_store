<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->with('error', 'Email hoặc mật khẩu không đúng')->withInput();
        }

        if ($user->status === 0) {
            return back()->with('error', 'Tài khoản của bạn đã bị khóa.');
        }

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.home');
        }

        return redirect()->route('home');
    }
}
