<header class="main-header">
    <div class="header-logo">
        <a href="{{ url('/') }}">
            {{-- Gọi file logo từ public/images/logo.png --}}
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </a>
    </div>

    <div class="header-auth">
        @auth
            {{-- Nếu đã đăng nhập thì hiện tên và nút Logout --}}
            <span class="user-name">Xin chào, {{ Auth::user()->fullname }}</span> |
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout">
                    Logout
                </button>
            </form>
        @else
            {{-- Nếu chưa đăng nhập thì hiện link Đăng nhập/Đăng ký --}}
            <a href="{{ route('login') }}" class="auth-link">Đăng nhập</a> |
            <a href="{{ route('register') }}" class="auth-link">Đăng ký</a>
        @endauth
    </div>
</header>
