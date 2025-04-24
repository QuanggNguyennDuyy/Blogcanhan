<x-guest-layout>
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.src='https://via.placeholder.com/150x60?text=Logo'">
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Username -->
            <div class="form-group">
                <label for="username" class="auth-label">Tên đăng nhập</label>
                <input id="username" class="auth-input" type="text" name="username" :value="old('username')" required autofocus />
                <x-input-error :messages="$errors->get('username')" class="auth-error" />
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="auth-label">Họ và tên</label>
                <input id="name" class="auth-input" type="text" name="name" :value="old('name')" required autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="auth-error" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="auth-label">Email</label>
                <input id="email" class="auth-input" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="auth-error" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="auth-label">Mật khẩu</label>
                <input id="password" class="auth-input"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="auth-error" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="auth-label">Xác nhận mật khẩu</label>
                <input id="password_confirmation" class="auth-input"
                    type="password"
                    name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="auth-error" />
            </div>

            <div class="text-divider">
                <span>hoặc</span>
            </div>

            <div class="flex items-center justify-between">
                <a class="auth-link" href="{{ route('login') }}">
                    Đã có tài khoản?
                </a>

                <button type="submit" class="auth-button">
                    Đăng ký
                </button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</x-guest-layout>
