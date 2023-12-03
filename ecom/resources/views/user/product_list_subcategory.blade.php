
	@include('user.layouts.template_header_logged')
<div class="page-navigation">
        <ul class="breadcrumb">
            @auth
            <li><a href="{{route('userdashboard')}}">Trang chủ</a></li>
            @endauth
            @guest
            <li><a href="/">Trang chủ</a></li>
            @endguest
            <li><a href="{{route('product list with category', ['categorySlug'=>$category->categorySlug])}}">{{$category->categoryName}}</a></li>
                <li><a href="">{{$subCategory->subCategoryName}}</a></li>
        </ul>
    </div>

    <div class="main-container grid-6-col">
        <div class="sidebar">
            <div class="sidebar-category">
                <div class="side-bar-title">
                    <h2 class="">DANH MỤC</h2>
                </div>
                <div class="side-bar-category">
                    @foreach($categories as $category)
                        <div class="category-sb"><a href="{{route('product list with category', ['categorySlug'=>$category->categorySlug])}}" class="cyan-link heavy-link">{{$category->categoryName.' - '.$category->categorySlug}}</a></div>
                    @endforeach
                </div>
            </div>
            <div class="sidebar-filter">
                <div class="side-bar-title">
                    <h2 class="">BỘ LỌC TÌM KIẾM</h2>
                </div>
                <div class="brand-filter">
                    <h3 class="">Tên thương hiệu</h3>
                    <div class="brand-choose">
                        <input type="checkbox" name="" id="">
                        <label for="">Thương hiệu</label><br>
                        <input type="checkbox" name="" id="">
                        <label for="">Thương hiệu</label><br>
                        <input type="checkbox" name="" id="">
                        <label for="">Thương hiệu</label><br>
                        <input type="checkbox" name="" id="">
                        <label for="">Thương hiệu</label><br>
                        <input type="checkbox" name="" id="">
                        <label for="">Thương hiệu</label><br>
                        <input type="checkbox" name="" id="">
                        <label for="">Thương hiệu</label><br>
                    </div>
                </div>
                <div class="price-range">
                    <h3 class="">Khoảng giá</h3>
                    <form action="" class="filter-product">
                        <input type="text" name="" id="" placeholder="Từ &#8363;">
                        <span class="price-range-line">-</span>
                        <input type="text" name="" id="" placeholder="Đến &#8363;">
                        <br><br>
                        <button type="submit" class="btn-apply">Áp dụng</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="product-list">
            <div class="product-list-header">
                <div class="product-list-title">
                    <h1 class="section-txt-title">{{$subCategory->subCategoryName}}</h1>
                </div>
                <div class="product-list-filter">
                    <div class="product-list-filter-content right">
                        <label for="">Sắp xếp theo: </label>
                        <select name="" id="">
                            <option value="Increase">Giá thấp đến cao</option>
                            <option value="Decrease">Giá cao đến thấp</option>
                            <option value="Alphabet">A - Z</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="product-list-content grid-4-col">
                @foreach($list_products as $product)
                <div class="preview-product">
                    <div class="product-ping width-common relative">
                        <a href="{{route('product detail_user',['categorySlug'=>$category->categorySlug, 'subCategorySlug'=>$subCategory->subCategorySlug,'productSlug'=>$product->productSlug])}}" class="image-common relative">
                            <div class="product-img sale">
                                <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" height="200" width="200">
                                <span class="sale-percent">50%</span>
                            </div>
                            <div class="product-info">
                                <div class="width-common price-block">
                                    <strong class="discount-price txt-16">{{$product->productDiscountPrice}} &#8363;</strong>
                                    <span class="original-price txt-12 right">{{$product->productOriginalPrice}} &#8363;</span>
                                </div>
                                <div class="product-name-block">
                                    <h3 class="width-common pr-name sp-bottom-5">
                                        <div class="product-name cyan-link">{{$product->productName.' '.$product->productID.'-'.$product->productCategoryID}}</div>
                                    </h3>
                                </div>
                                <div class="rate-block">
                                    <span class="rate-star left">4.5 <i class="fa-solid fa-star"></i></span>
                                    <span class="sold-product-number right">Đã bán: 100</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="pagination-container">
                    <div class="pagination">
                {{$list_products->links()}}
{{--                        <a href="#" class="active">1</a>--}}
{{--                        <a href="#">2</a>--}}
{{--                        <a href="#">3</a>--}}
{{--                        <a href="#">4</a>--}}
{{--                        <a href="#">5</a>--}}
{{--                        <a href="#">6</a>--}}
{{--                        <a href="#">&raquo;</a>--}}
                    </div>
            </div>

        </div>
    </div>

@include('user.layouts.template_footer')
