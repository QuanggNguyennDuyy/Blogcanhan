<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4299e1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #3182ce;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
        <a href="{{ route('login') }}" class="login-button">Đăng nhập</a>
    </div>
</body>
</html>
