<x-guest-layout>
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.src='https://via.placeholder.com/150x60?text=Logo'">
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 auth-success" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="form-group">
                <label for="username" class="auth-label">Tên đăng nhập</label>
                <input id="username" class="auth-input" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="auth-error" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="auth-label">Mật khẩu</label>
                <input id="password" class="auth-input"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="auth-error" />
            </div>

            <!-- Remember Me -->
            <div class="form-group flex items-center">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Ghi nhớ đăng nhập</label>
            </div>

            <div class="flex items-center justify-between form-group">
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                @endif

                <button type="submit" class="auth-button">
                    Đăng nhập
                </button>
            </div>

            <div class="text-divider">
                <span>hoặc</span>
            </div>

            <div class="text-center">
                <span class="text-sm text-gray-600">Chưa có tài khoản? </span>
                <a href="{{ route('register') }}" class="auth-link">
                    Đăng ký ngay
                </a>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</x-guest-layout>
