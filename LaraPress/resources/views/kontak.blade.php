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
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 75%;
            margin: 40px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .col {
            display: grid;
            grid-template-columns: auto auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            width: 100%;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Kontak Tim Kami</h1>
        <div class="col">
            <form action="#" method="post">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama kamu" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email kamu" required>

                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" placeholder="Tulis pesan kamu..." required></textarea>

                <button type="submit">Kirim Pesan</button>
            </form>
            <form action="#" method="post">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama kamu" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email kamu" required>

                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" placeholder="Tulis pesan kamu..." required></textarea>

                <button type="submit">Kirim Pesan</button>
            </form>
        </div>
    </div>

</body>
</html>

</body>
</html>

