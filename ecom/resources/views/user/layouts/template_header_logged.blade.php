<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PING Cosmetics Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/colored-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="header-wrapper">
        <div class="header-container">
            <div class="logo-site">
                @auth
                <a href="{{route('userdashboard')}}" class="logo">
                    <img src="{{ asset('assets/logo.svg')}}" alt="logo">
                </a>
                @endauth
                @guest
                        <a href="/" class="logo">
                            <img src="{{ asset('assets/logo.svg')}}" alt="logo">
                        </a>
                @endguest
            </div>

            <div class="search-site">
                <div class="suggested-keywords">
                    @foreach($subcategories as $subcategory_header)
                        @php
                        $categorySlug = getCategoryByCategoryID($subcategory_header->categoryID)->categorySlug;
                        @endphp
                        <a href="{{route('productlist', ['categorySlug'=>$categorySlug, 'subCategorySlug'=>$subcategory_header->subCategorySlug])}}" class="white-anchor heavy-link">{{$subcategory_header->subCategoryName}}</a>
                    @endforeach
                </div>

                <div class="search-cart">
                    <form action="">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." class="input-search" name="search">
                        <button type="submit" class="btn-submit-search">
                            <img src="{{ asset('assets/search-icon.svg')}}" alt="Search">
                        </button>
                    </form>
                    <div class="item-header cart">
                        <a href="" class="white-anchor">
                            <img src="{{ asset('assets/cart-icon.svg')}}" alt="">
                        </a>
                    </div>

                    <div class="item-header logout">
                        <a href="" class="white-anchor">
                            <img src="{{ asset('assets/login-icon.svg')}}" alt="">
                        </a>
                        <div class="text">
                            @auth
                            <a href="" class="white-anchor heavy-link">{{Auth::user()->name}}</a>
                            <br>
                            <a href="{{ route('logout') }}" class="white-anchor heavy-link">Đăng xuất</a>
                            @endauth
                            @guest
                            <a href="{{route('login')}}" class="white-anchor heavy-link">Đăng nhập</a>
                            <br>
                            <a href="{{route('register')}}" class="white-anchor heavy-link">Đăng ký</a>
                            @endguest
                        </div>
                    </div>

                    <div class="item-header support">
                        <a href="" class="white-anchor">
                            <img src="{{ asset('assets/phone-icon.svg')}}" alt="">
                        </a>
                        <a href="" class="white-anchor heavy-link">Hỗ trợ <br> khách hàng</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="top-bar">
        <a href="" class="category-fixed" style="font-weight: 600; background: #fff;">DANH MỤC</a>
        @foreach($categories as $category)
        <div class="sub-nav">
            <button class="btn-sub-nav">{{$category->categoryName}} <i class="fa fa-caret-down"></i></button>
            <div class="sub-nav-content">
                @foreach($subcategories as $subcategory_header)
                    @if($subcategory_header->categoryID == $category->categoryID)
                        <a href="{{route('productlist', ['categorySlug'=>$category->categorySlug, 'subCategorySlug'=>$subcategory_header->subCategorySlug])}}" class="heavy-link">{{$subcategory_header->subCategoryName}}</a>
                    @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

