<header class="main-header">
    <div class="header-logo">
        <a href="{{ url('/') }}">
            {{-- Gọi file logo từ public/images/logo.png --}}
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </a>
    </div>

@auth
        {{-- Nếu đã đăng nhập thì hiện tên và nút Logout --}}
        <span>Xin chào, {{ Auth::user()->fullname }}</span> |
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: blue; cursor: pointer; text-decoration: underline;">
                Logout
            </button>
        </form>
    @else
        {{-- Nếu chưa đăng nhập thì hiện link Đăng nhập/Đăng ký --}}
        <a href="{{ route('login') }}">Đăng nhập</a> |
        <a href="{{ route('register') }}">Đăng ký</a>
    @endauth

</header>
