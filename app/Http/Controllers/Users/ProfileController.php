<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    public function chage_pass()
    {
        return view('users.change_pass');
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu cũ',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu quá ngắn',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không trùng khớp'
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu cũ không chính xác.');
        }

        $user = User::find(Auth::id());
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('user.profile')->with('success', 'Cập nhật mật khẩu thành công');
    }

    public function update_form(String $id){
        $user = User::findOrFail($id);

        return view('users.update_profile', compact('user'));
    }

    public function update_profile(Request $request, $id){
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|regex:/^0[0-9]{9}$/',
            'address' => 'nullable|string|max:255'
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.max' => 'Tên quá dài',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'address.max' => 'Địa chỉ quá dài'
        ]);

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công');
    }
}
