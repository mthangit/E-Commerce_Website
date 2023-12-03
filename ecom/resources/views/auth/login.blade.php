<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | PING Cosmetics</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/images/logo/colored-logo.png') }}">
    <!-- Include Tailwind CSS styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="header-wrapper white fixed">
        <div class="header-container flex">
            <div class="logo-site">
                <a href="/" class="logo">
                    <img src="assets/color-logo.svg" alt="logo">
                </a>
            </div>
            <div class="page-header">
                <h2 class="section-txt-title">Đăng nhập</h2>
            </div>
        </div>
    </div>

    <div class="login-wrapper">
        <div class="login">
            <div class="txt-divider">Đăng nhập</div>
            <br>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <!-- Email Address -->
                <!-- <label for="email-user" style="font-weight: 400;">Email</label><br>
                <x-text-input id="email-user" type="email" name="email" placeholder="Nhập email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
                <label for="email-user" style="font-weight: 400;">Email</label><br>
                <input type="email" id="email-user" name="email" placeholder="Nhập email" required><br><br>
                <label for="password-user" style="font-weight: 400;">Mật khẩu</label><br>
                <input type="password" id="password-user" name="password" placeholder="Nhập mật khẩu"
                    class="password-hide-3" required><i class="fa-regular fa-eye txt-cyan reveal-pass-3"
                    onclick="togglePassword(3)"></i>
                <br><br>
                <!-- Password -->
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
                <!-- <label for="password-user" style="font-weight: 400;">Mật khẩu</label><br>
                <x-text-input id="password-user" type="password" name="password" placeholder="Nhập mật khẩu"
                    class="password-hide-3" required autocomplete="current-password" />
                <i class="fa-regular fa-eye txt-cyan reveal-pass-3" onclick="togglePassword(3)"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->

                <!-- Remember Me -->
                <!-- <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div> -->

                <button class="btn-login txt-uppercase" type="submit">Đăng nhập</button>
            </form>
            <br>
            <a href="{{ route('password.request') }}" class="txt-cyan txt-14 right" id="forget-password">Quên mật
                khẩu</a><br>
            <hr style="width: 70%; height: 1px; background-color: var(--black); border: none; margin: 20px auto;">
            <form method="GET">
                @csrf
                <div class="create-acc txt-center">
                    <span>Bạn chưa có tài khoản? <a href="{{route('register.store')}}" class="txt-cyan orange-link">Tạo
                            tài
                            khoản</a></span>
                </div>
            </form>
        </div>
    </div>
    <footer style="background-color: white; color: var(--cyan);">
        <div class="footer-copyright txt-center" style="font-weight: 400;">Copyright by PING Cosmetics - Based in Ho Chi Minh City</div>
        <div class="footer-hotline txt-center">Hotline: 012345678</div>
    </footer>

    <script src="https://kit.fontawesome.com/6594d9651c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
