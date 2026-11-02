<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Pantau Karhutla</title>
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
            width: min(400px, calc(100% - 40px));
            padding: 32px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 8px 28px rgba(25, 50, 35, 0.12);
        }

        h1 {
            margin: 0 0 8px;
            color: #205b3b;
        }

        .intro {
            margin: 0 0 24px;
            color: #5d6b61;
        }

        label {
            display: block;
            margin: 16px 0 6px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            box-sizing: border-box;
            width: 100%;
            padding: 11px;
            border: 1px solid #bdc9c0;
            border-radius: 6px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 16px 0;
        }

        .remember label {
            margin: 0;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 6px;
            background: #276b46;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            margin: 16px 0;
            padding: 10px;
            border-radius: 6px;
            background: #fff0f0;
            color: #a12424;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Pantau Karhutla</h1>
        <p class="intro">Masuk untuk melaporkan atau memantau informasi kejadian.</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="username"
                required
                autofocus
            >

            <label for="password">Kata sandi</label>
            <input
                id="password"
                type="password"
                name="password"
                autocomplete="current-password"
                required
            >

            <div class="remember">
                <input id="remember" type="checkbox" name="remember" value="1">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit">Masuk</button>
        </form>
    </main>
</body>
</html>