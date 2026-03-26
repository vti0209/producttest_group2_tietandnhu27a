<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-lg">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">👤 Đăng ký</h2>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Tài khoản</label>
                <input type="text" name="username"
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-blue-50"
                    placeholder="hieupc">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <div class="relative">
                    <input type="password" name="password" class="w-full px-4 py-2 mt-1 border rounded-lg bg-blue-50"
                        placeholder="•••">
                </div>
            </div>

            <button type="submit" class="w-full py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                Đăng ký
            </button>
        </form>

        <p class="text-center text-sm text-gray-600">
            Đã có tài khoản? <a href="{{ route('login') }}" class="text-blue-600 font-semibold">Đăng nhập</a>
        </p>
    </div>
</div>