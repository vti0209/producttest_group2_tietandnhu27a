<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Trang web')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('styles')
</head>

<body>

    {{-- Header --}}
    @include('layouts.header')

    {{-- Nội dung --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Script --}}
    @include('layouts.script')

    @yield('scripts')

</body>

</html>