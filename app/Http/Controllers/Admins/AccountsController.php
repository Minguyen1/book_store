<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = User::latest()->paginate(10);

        return view('admins.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ], [
            'name.required' => 'Họ tên không được để trống',
            'name.max' => 'Họ tên quá dài',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.max' => 'Email quá dài',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu quá ngắn',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không trùng khớp'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.accounts')->with('success', 'Tạo tài khoản thành công');
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
        $account = User::findOrFail($id);

        return view('admins.accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|regex:/^0[0-9]{9}$/',
            'address' => 'nullable|string|max:255'
        ], [
            'name.required' => 'Họ tên không được để trống',
            'name.max' => 'Họ tên quá dài',
            'email.required' => 'Email không được để trống',
            'email.max' => 'Email quá dài',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'address.max' => 'Địa chỉ quá dài'
        ]);

        $account->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role
        ]);

        return redirect()->route('admin.accounts')->with('success', 'Cập nhật tài khoản thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateAccountStatus($id){
        $account = User::findOrFail($id);
        $account->status = 0;
        $account->save();

        return redirect()->route('admin.accounts')->with('success', 'Cập nhật trạng thái tài khoản thành công');
    }

    public function activateAccount($id){
        $account = User::findOrFail($id);
        $account->status = 1;
        $account->save();

        return redirect()->route('admin.accounts')->with('success', 'Mở khóa tài khoản thành công');
    }
}
