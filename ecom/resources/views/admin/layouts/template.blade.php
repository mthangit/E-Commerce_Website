<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title')</title>

    <!-- page css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/images/logo/colored-logo.png') }}">
    <link href="{{ asset('dashboard/assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <!-- page css -->
    <link href="~/admin_assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Core css -->
    <link href="{{ asset('dashboard/assets/css/app.min.css') }}" rel="stylesheet">

    <link href="https://fonts.cdnfonts.com/css/be-vietnam-pro" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css
" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    body {
        font-family: 'Be Vietnam Pro';
    }
</style>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="" style="margin-top: 18px; margin-right: 18px;">
                        <img src="{{ asset('dashboard/assets/images/logo/color-logo.svg') }}" alt="Logo">
                        <img class="logo-fold" src="{{ asset('dashboard/assets/images/logo/logo-fold.svg') }}"
                            alt="Logo" style="width: 41px; margin-left: 20px; margin-top: -5px;">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="index.html">
                        <img src="{{ asset('dashboard/assets/images/logo/logo-white.png') }}" alt="Logo">
                        <img class="logo-fold" src="{{ asset('dashboard/assets/images/logo/logo-fold-white.png') }}"
                            alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="{{ asset('assets/admin-logo.png') }}" alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img src="{{ asset('assets/admin-logo.png') }}" alt="">
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold">{{ Auth::user()->name }}
                                            </p>
                                            <p class="m-b-0 opacity-07">Quản lý</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('logout') }}" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Đăng xuất</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="{{ route('admindashboard') }}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                                <span class="title">Quản lý sản phẩm</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('allproduct') }}">Sản phẩm</a>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);">Danh mục</a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('allcategory') }}">Danh mục cha</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('allsubcategory') }}">Danh mục con</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-build"></i>
                                </span>
                                <span class="title">Quản lý đơn hàng</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('allorder') }}">Quản lý đơn hàng</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-hdd"></i>
                                </span>
                                <span class="title">Quản lý tài khoản</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('allaccount') }}">Tài khoản khách hàng</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-form"></i>
                                </span>
                                <span class="title">Quản lý bài đăng</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('allblog') }}">Quản lý bài đăng</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-form"></i>
                                </span>
                                <span class="title">Quản lý khác</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('alldiscount') }}">Mã giảm giá</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('allbrand') }}">Quản lí thương hiệu</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-pie-chart"></i>
                                </span>
                                <span class="title">Thống kê doanh số</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('checkProduct') }}">Thông kê theo sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{ route('checkSubcategory') }}">Thông kê sản phẩm theo danh mục</a>
                                </li>
                                <li>
                                    <a href="">Doanh số tháng</a>
                                </li>
                                <li>
                                    <a href="">Doanh số năm</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-form"></i>
                                </span>
                                <span class="title">Chăm sóc khách hàng</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/chatify">Hỗ trợ khách hàng</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">


                <!-- Content Wrapper START -->
                <div class="main-content">
                    @yield('content')
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">PING Cosmetics - 2022.</p>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ asset('dashboard/assets/js/vendors.min.js') }}"></script>

    <!-- page js -->
    <script src="{{ asset('dashboard/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/pages/dashboard-default.js') }}"></script>

    <!-- Core JS -->
    <script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('customJS')
    <!-- page jsCHO TRANG ALLPRODUCT
     Core Vendors JS
    <script src="{{ asset('dashboard/assets/js/vendors.min.js') }}"></script>
     page js
    <script src=" {{ asset('dashboard/assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/js/pages/e-commerce-order-list.js') }}"></script>

     Core JS
    <script src=" {{ asset('dashboard/assets/js/app.min.js') }}"></script> -->
    <!-- Content Wrapper END KẾT THÚC TRANG PRODUCT Ở ĐÂY -->

</body>

</html>
