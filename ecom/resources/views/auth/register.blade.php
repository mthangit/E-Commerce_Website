<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký | PING Cosmetics</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/images/logo/colored-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <div class="header-wrapper white fixed" >
        <div class="header-container flex">
            <div class="logo-site">
                <a href="/" class="logo">
                    <img src="assets/color-logo.svg" alt="logo">
                </a>
            </div>
            <div class="page-header">
                <h2 class="section-txt-title">Đăng ký</h2>
            </div>
        </div>
    </div>
    
    <div class="signup-wrapper">
        <div class="signup">
            <div class="txt-divider">Đăng ký</div>
            <form method="POST" action="{{route('register.store')}}" class="signup-form active-form"  id="first-page-signup" >
                @csrf
                <label for="name" style="font-weight: 400;">Họ và tên</label><br>
                <input type="text" name="name" id="name" placeholder="Nhập họ và tên"><br><br>
                <label for="email" style="font-weight: 400;">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Nhập email"><br><br>
                <label for="password" style="font-weight: 400;">Mật khẩu</label><br>
                <input type="password" name="password" id="password" class="password-hide-1" required autocomplete="new-password" placeholder="Nhập mật khẩu"><i class="fa-regular fa-eye txt-cyan reveal-pass-1" onclick="togglePassword(1)"></i><br><br>
                <label for="password_confirmation" style="font-weight: 400;">Xác nhận mật khẩu</label><br>
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="password-hide-1" placeholder="Nhập lại mật khẩu"><i class="fa-regular fa-eye txt-cyan reveal-pass-2" onclick="togglePassword(2)"></i><br><br>
                <button class="btn-signup txt-uppercase" type="submit">Đăng ký</button>
            </form>
            <!-- <form action="" class="signup-form inactive-form" id="second-page-signup">
                <label for="phone-register-user" style="font-weight: 400;">Số điện thoại</label><br>
                <input type="tel" name="phone-register-user" id="phone-register-user" placeholder="Nhập số điện thoại"><br><br>
                <label for="dob-register-user" style="font-weight: 400;">Ngày sinh</label><br>
                <input type="date" name="dob-register-user" id="dob-register-user"><br><br>
                <label for="gender-select" style="font-weight: 400;">Giới tính</label>
                <select name="gender-register-user" id="gender-select" style="margin-left: 30px; height: 30px;">
                    <option value="" selected>Chọn giới tính</option>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                    <option value="unknown">Không xác định</option>
                </select>
                <br><br>
                <label for="address-register-user" style="font-weight: 400;">Địa chỉ</label><br>
                <input type="text" name="address-register-user" id="address-register-user" placeholder="Nhập số nhà, tên đường, phường, xã, tỉnh, thành phố"><br><br>
                <button class="btn-signup txt-uppercase" type="submit">Đăng ký</button>
            </form> -->
        </div>
    </div>

    <script src="https://kit.fontawesome.com/6594d9651c.js" crossorigin="anonymous"></script>
    <script src="js/signup-script.js"></script>
</body>
</html>