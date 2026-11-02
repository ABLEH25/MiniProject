<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pantau Karhutla</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f1f5f2;
            color: #24332a;
            font-family: Arial, sans-serif;
        }

        .card {
            width: min(500px, calc(100% - 40px));
            padding: 32px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 8px 28px rgba(25, 50, 35, 0.12);
        }

        h1 {
            color: #205b3b;
        }

        button {
            padding: 11px 18px;
            border: 0;
            border-radius: 6px;
            background: #276b46;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Selamat datang, {{ auth()->user()->name }}</h1>
        <p>Peran akun: <strong>{{ auth()->user()->role }}</strong></p>
        <p>Kamu berhasil masuk ke aplikasi Pantau Karhutla.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </main>
</body>
</html>