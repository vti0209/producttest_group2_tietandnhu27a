<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'fullname' => $request->fullname,
            'role'     => $request->role,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);
        return redirect()->route('users.index')->with('success', 'Thêm user thành công!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $data = [
            'username' => $request->username,
            'email'    => $request->email,
            'fullname' => $request->fullname,
            'role'     => $request->role,
        ];
        // Chỉ cập nhật mật khẩu nếu người dùng có nhập mới
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'Đã xóa user!');
    }
}
