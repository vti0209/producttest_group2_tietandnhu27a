<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index(Request $request)
        {
            // 1. Khởi tạo query
            $query = User::query();

            // 2. Tìm theo tên hoặc email (nếu có)
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('fullname', 'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
                });
            }

            // 3. Lọc theo ngày tạo (Từ ngày)
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            // 4. Lọc theo ngày tạo (Đến ngày)
            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            // 5. Thực hiện phân trang và giữ lại các giá trị lọc trên URL
            $users = $query->orderBy('id', 'desc')->paginate(5);

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
