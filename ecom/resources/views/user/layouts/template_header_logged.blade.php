<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PING Cosmetics Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,600">
    <link href="https://pennypixels.pennymacusa.com/css/1_4_1/pp.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/colored-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="header-wrapper">
        <div class="header-container">
            <div class="logo-site">
                @auth
                    <a href="{{ route('userdashboard') }}" class="logo">
                        <img src="{{ asset('assets/logo.svg') }}" alt="logo">
                    </a>
                @endauth
                @guest
                    <a href="/" class="logo">
                        <img src="{{ asset('assets/logo.svg') }}" alt="logo">
                    </a>
                @endguest
            </div>

            <div class="search-site">
                <div class="suggested-keywords">
                    @foreach ($subcategories_5 as $subcategory_header)
                        @php
                            $categorySlug = getCategoryByCategoryID($subcategory_header->categoryID)->categorySlug;
                        @endphp
                        <a href="{{ route('productlist', ['categorySlug' => $categorySlug, 'subCategorySlug' => $subcategory_header->subCategorySlug]) }}"
                            class="white-anchor heavy-link">{{ $subcategory_header->subCategoryName }}</a>
                    @endforeach
                </div>

                <div class="search-cart">
                    <form method="get" action="{{ route('search product') }}">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." class="input-search" name="keyword">
                        <button type="submit" class="btn-submit-search">
                            <img src="{{ asset('assets/search-icon.svg') }}" alt="Search">
                        </button>
                    </form>
                    <div class="item-header cart">
                        <a href="{{ route('cart') }}" class="white-anchor">
                            <img src="{{ asset('assets/cart-icon.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="item-header logout">
                        <a href="" class="white-anchor">
                            <img src="{{ asset('assets/login-icon.svg') }}" alt="">
                        </a>
                        <div class="text">
                            @auth
                                <a href="{{ route('detailuseraccount') }}"
                                    class="white-anchor heavy-link">{{ Auth::user()->name }}</a>
                                <br>
                                <a href="{{ route('logout') }}" class="white-anchor heavy-link">Đăng xuất</a>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="white-anchor heavy-link">Đăng nhập</a>
                                <br>
                                <a href="{{ route('register') }}" class="white-anchor heavy-link">Đăng ký</a>
                            @endguest
                        </div>
                    </div>

                    <div class="item-header support">
                        <a href="" class="white-anchor">
                            <img src="{{ asset('assets/phone-icon.svg') }}" alt="">
                        </a>
                        <a href="" class="white-anchor heavy-link">Hỗ trợ <br> khách hàng</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="top-bar">
        <a href="" class="category-fixed" style="font-weight: 600; background: #fff;">DANH MỤC</a>
        @foreach ($categories as $category)
            <div class="sub-nav">
                <button class="btn-sub-nav">{{ $category->categoryName }} <i class="fa fa-caret-down"></i></button>
                <div class="sub-nav-content">
                    @foreach ($subcategories as $subcategory_header)
                        @if ($subcategory_header->categoryID == $category->categoryID)
                            <a href="{{ route('productlist', ['categorySlug' => $category->categorySlug, 'subCategorySlug' => $subcategory_header->subCategorySlug]) }}"
                                class="heavy-link">{{ $subcategory_header->subCategoryName }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
