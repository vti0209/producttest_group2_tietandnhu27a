<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);
        return redirect()->back()->with('success', 'Thêm User thành công!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->only(['username', 'fullname', 'email', 'role']);

        // Nếu có nhập mật khẩu mới thì mới cập nhật
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Cập nhật User thành công!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa User!');
    }
}
