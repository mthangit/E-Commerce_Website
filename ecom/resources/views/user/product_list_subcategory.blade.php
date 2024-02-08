@include('user.layouts.template_header_logged')
<div class="page-navigation">
    <ul class="breadcrumb">
        @auth
            <li><a href="{{ route('userdashboard') }}">Trang chủ</a></li>
        @endauth
        @guest
            <li><a href="/">Trang chủ</a></li>
        @endguest
        <li><a
                href="{{ route('product list with category', ['categorySlug' => $category->categorySlug]) }}">{{ $category->categoryName }}</a>
        </li>
        <li><a href="">{{ $subCategory->subCategoryName }}</a></li>
    </ul>
</div>

<style>
    .larger-text {
        font-size: 16px;
        /* Điều chỉnh kích thước chữ theo ý muốn */
    }
</style>

<?php
$thisCategory = $category;
?>
<div class="main-container grid-6-col">
    <div class="sidebar">
        <div class="sidebar-category">
            <div class="side-bar-title">
                <h2 class="">DANH MỤC</h2>
            </div>
            <div class="side-bar-category">
                @foreach ($categories as $category)
                    <div class="category-sb"><a
                            href="{{ route('product list with category', ['categorySlug' => $category->categorySlug]) }}"
                            class="cyan-link heavy-link">{{ $category->categoryName }}</a></div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="sidebar-filter">
            <div class="side-bar-title" style="margin-bottom: 5px">
                <h2 class="">BỘ LỌC TÌM KIẾM</h2>
            </div>
            <div class="brand-filter">
                <h4> Thương hiệu </h4>
                <div class="brand-choose form-check">
                    @foreach ($brands as $brand)
                        <input {{ in_array($brand->brandID, $brandsArray) ? 'checked' : '' }}
                            class="brand-label form-check-input" type="checkbox" name="brand-checked"
                            id="brand-{{ $brand->brandID }}" value="{{ $brand->brandName }}">
                        <label class="form-check-label"
                            for="brand-{{ $brand->brandID }}">{{ $brand->brandName }}</label><br>
                    @endforeach
                </div>
            </div>
            <div class="price-range">
                <h4> Khoảng giá </h4>
                <div class="form-check">
                    <input {{ in_array('duoi300', $pricerange) ? 'checked' : '' }} class="form-check-input price-label"
                        type="checkbox" value="duoi300" id="duoi300">
                    <label class="form-check-label larger-text" for="duoi300">
                        Dưới 300.000 đ
                    </label>
                </div>
                <div class="form-check">
                    <input {{ in_array('300-500', $pricerange) ? 'checked' : '' }} class="form-check-input price-label"
                        type="checkbox" value="300-500" id="300-500">
                    <label class="form-check-label larger-text" for="300-500">
                        Từ 300.000 đ - 500.000 đ
                    </label>
                </div>

                <div class="form-check">
                    <input {{ in_array('500-700', $pricerange) ? 'checked' : '' }} class="form-check-input price-label"
                        type="checkbox" value="500-700" id="500-700">
                    <label class="form-check-label larger-text" for="500-700">
                        Từ 500.000 đ - 700.000 đ
                    </label>
                </div>

                <div class="form-check">
                    <input {{ in_array('700-1000', $pricerange) ? 'checked' : '' }}
                        class="form-check-input price-label" type="checkbox" value="700-1000" id="700-1000">
                    <label class="form-check-label larger-text" for="700-1000">
                        Từ 700.000 đ - 1.000.000 đ
                    </label>
                </div>

                <div class="form-check">
                    <input {{ in_array('1000-2000', $pricerange) ? 'checked' : '' }}
                        class="form-check-input price-label" type="checkbox" value="1000-2000" id="1000-2000">
                    <label class="form-check-label larger-text" for="1000-2000">
                        Từ 1.000.000 đ - 2.000.000 đ
                    </label>
                </div>

                <div class="form-check">
                    <input {{ in_array('tren2trieu', $pricerange) ? 'checked' : '' }}
                        class="form-check-input price-label" type="checkbox" value="tren2trieu" id="tren2trieu">
                    <label class="form-check-label larger-text" for="tren2trieu">
                        Trên 2.000.000 đ
                    </label>
                </div>
                <br>
                {{--                    </form> --}}
            </div>

        </div>
    </div>
    <div class="product-list">
        <div class="product-list-header">
            <div class="product-list-title">
                <h1 class="section-txt-title">{{ $subCategory->subCategoryName }}</h1>
            </div>
            <div class="product-list-filter">
                <div class="product-list-filter-content right">
                    <label for="">Sắp xếp theo: </label>
                    <select id="sort-select" name="">
                        <option value="Default" @if ($sortValue == 'Default') selected @endif>Gợi ý mua</option>
                        <option value="asc" @if ($sortValue == 'asc') selected @endif>Giá thấp đến cao
                        </option>
                        <option value="desc" @if ($sortValue == 'desc') selected @endif>Giá cao đến thấp
                        </option>
                        <option value="a-z" @if ($sortValue == 'a-z') selected @endif>A - Z</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="product-list-content grid-4-col">
            @foreach ($list_products as $product)
                <div class="preview-product">
                    <div class="product-ping width-common relative">
                        <a href="{{ route('detail product', ['categorySlug' => $thisCategory->categorySlug, 'subCategorySlug' => $subCategory->subCategorySlug, 'productSlug' => $product->productSlug]) }}"
                            class="image-common relative">
                            <div class="product-img sale">
                                <img src="{{ asset($product->productImage) }}" alt="" height="200"
                                    width="200">
                                <span class="sale-percent">{{ (1 - round($product->productDiscountPrice / $product->productOriginalPrice, 2)) * 100 . '%' }}</span>
                            </div>
                            <div class="product-info">
                                <div class="width-common price-block">
                                    <strong
                                        class="discount-price txt-16">{{ formatCurrency($product->productDiscountPrice) }}
                                        &#8363;</strong>
                                    <span
                                        class="original-price txt-12 right">{{ formatCurrency($product->productOriginalPrice) }}
                                        &#8363;</span>
                                </div>
                                <div class="product-name-block">
                                    <h3 class="width-common pr-name sp-bottom-5">
                                        <div class="product-name cyan-link">{{ $product->productName }}</div>
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
            <nav>
                <div class="pagination">
                    {{ $list_products->links() }}
                </div>
            </nav>
        </div>
    </div>
</div>

@include('user.layouts.template_footer')
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    // Bắt sự kiện khi giá trị của dropdown chọn thay đổi
    // document.getElementById('sort-select').addEventListener('change', function() {
    //     // Lấy giá trị được chọn
    //     var selectedValue = this.value;

    // Sắp xếp lại các sản phẩm trên trang hiện tại
    // });

    // Hàm sắp xếp lại sản phẩm trên trang hiện tại
    // function sortProducts(sortBy) {
    //     var productList = document.querySelector('.product-list-content');
    //     var products = Array.from(productList.getElementsByClassName('preview-product'));

    //     products.sort(function(a, b) {
    //         if (sortBy === 'Increase' || sortBy === 'Decrease') {
    //             var aPrice = parseFloat(a.querySelector('.discount-price').textContent.replace('₫',
    //                 '').replace(',', ''));
    //             var bPrice = parseFloat(b.querySelector('.discount-price').textContent.replace('₫',
    //                 '').replace(',', ''));

    //             return sortBy === 'Increase' ? aPrice - bPrice : bPrice - aPrice;
    //         } else if (sortBy === 'Alphabet') {
    //             var aValue = a.querySelector('.product-name').textContent.toLowerCase();
    //             var bValue = b.querySelector('.product-name').textContent.toLowerCase();
    //             return aValue.localeCompare(bValue);
    //         }
    //     });

    // // Xóa các sản phẩm hiện tại
    // productList.innerHTML = '';

    // // Thêm lại sản phẩm đã được sắp xếp
    // products.forEach(function(product) {
    //     productList.appendChild(product);
    // });
    // }

    $(".brand-label").change(function() {
        applyFilters();
    });


    $(".price-label").change(function() {
        applyFilters();
    });

    $("#sort-select").change(function() {
        applyFilters();
    });

    function applyFilters() {

        var sortValue = $("#sort-select").val();

        var brandIDs = [];
        $(".brand-label:checked").each(function() {
            brandIDs.push($(this).val());
        });

        var priceRanges = [];
        $(".price-label:checked").each(function() {
            priceRanges.push($(this).val());
        });



        var url = "{{ url()->current() }}?"
        if (brandIDs.length > 0) {
            url += "&brand=" + brandIDs.toString();
        }

        if (priceRanges.length > 0) {
            url += "&price=" + priceRanges.toString();
        }

        // change sort value in url
        if (sortValue != "Default") {
            url += "&sort=" + sortValue;
        }

        window.location.href = url;
    }
</script>
