<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiện trang đăng nhập
    public function showLogin() {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request) {
        $credentials = $request->only('username', 'password'); //Lấy duy nhất 2 trường username và password từ form gửi lên.
        if (Auth::attempt($credentials)) { //Hàm attempt sẽ kiểm tra xem có tồn tại người dùng nào trong database với username và password đã cho hay không. Nếu có, nó sẽ tự động đăng nhập người dùng đó.
            return redirect()->route('products.index');
        }
        return back()->with('error', 'Sai tài khoản hoặc mật khẩu!');
    }

    // Hiện trang đăng ký
    public function showRegister() {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request) {
        User::create([  //Gọi Model User để chèn một dòng dữ liệu mới vào bảng users
            'username' => $request->username,
            'name' => $request->fullname,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // Mặc định là user
        ]);
        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    // Đăng xuất
    public function logout() {
        Auth::logout();  //Xóa session hiện tại của người dùng, làm mất trạng thái đăng nhập.
        return redirect()->route('login');
    }
}
