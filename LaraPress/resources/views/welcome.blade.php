<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang di LaraPress</title>
    @vite(['resources/css/main.css', 'resources/js/main.js'])
</head>
<body>
    <nav>
        <div class="logo">
            LaraPress
        </div>
        <div class="nav-link">
            <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
        </div>
    </nav>
    <div class="main">
         <h1>Selamat Datang di Blog LaraPress</h1>
        <p>Ini adalah halaman utama dari aplikasi blog kita.</p>
    </div>
</body>
</html>

