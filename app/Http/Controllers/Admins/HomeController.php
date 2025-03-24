<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.dashboard');
    }


    public function profile()
    {
        $admin = Auth::user();
        return view('admins.profiles.pro', compact('admin'));
    }

    public function changePasswordForm()
{
    return view('admins.profiles.change_pass');
}

public function updatePassword(Request $request)
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

    return redirect()->route('admin.home')->with('success', 'Cập nhật mật khẩu thành công');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
