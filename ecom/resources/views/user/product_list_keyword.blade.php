
	@include('user.layouts.template_header_logged')
<div class="page-navigation">
        <ul class="breadcrumb">
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Từ khoá</a></li>
            <li><a href=""></a></li>
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
                    <div class="category-sb"><a href="{{route('product list with category', ['categorySlug'=>$category->categorySlug])}}" class="cyan-link heavy-link">{{$category->categoryName}}</a></div>
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
                    <h1 class="section-txt-title">{{$keyword}}</h1>
                </div>
                <div class="product-list-filter">
                    <div class="product-list-filter-content right">
                        <label for="">Sắp xếp theo: </label>
                        <select id="sort-select" name="">
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
                        <a href="{{route('detail product',['categorySlug'=>getCategoryByProductID($product->productID)->categorySlug,'subCategorySlug'=>getSubCategoryByProductID($product->productID)->subCategorySlug,'productSlug'=>$product->productSlug])}}" class="image-common relative">
                            <div class="product-img sale">
                                <img src="{{asset($product->productImage)}}" alt="" height="200" width="200">
                                <span class="sale-percent">50%</span>
                            </div>
                            <div class="product-info">
                                <div class="width-common price-block">
                                    <strong class="discount-price txt-16">{{$product->productDiscountPrice}} &#8363;</strong>
                                    <span class="original-price txt-12 right">{{$product->productOriginalPrice}} &#8363;</span>
                                </div>
                                <div class="product-name-block">
                                    <h3 class="width-common pr-name sp-bottom-5">
                                        <div class="product-name cyan-link">{{$product->productName}}</div>
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
                        {{$list_products->links()}}
                    </div>
                </nav>
            </div>

        </div>
    </div>

@include('user.layouts.template_footer')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bắt sự kiện khi giá trị của dropdown chọn thay đổi
        document.getElementById('sort-select').addEventListener('change', function() {
            // Lấy giá trị được chọn
            var selectedValue = this.value;

            // Sắp xếp lại các sản phẩm trên trang hiện tại
            sortProducts(selectedValue);
        });

        // Hàm sắp xếp lại sản phẩm trên trang hiện tại
        function sortProducts(sortBy) {
            var productList = document.querySelector('.product-list-content');
            var products = Array.from(productList.getElementsByClassName('preview-product'));

            products.sort(function(a, b) {
                if (sortBy === 'Increase' || sortBy === 'Decrease') {
                    var aPrice = parseFloat(a.querySelector('.discount-price').textContent.replace('₫', '').replace(',', ''));
                    var bPrice = parseFloat(b.querySelector('.discount-price').textContent.replace('₫', '').replace(',', ''));

                    return sortBy === 'Increase' ? aPrice - bPrice : bPrice - aPrice;
                } else if (sortBy === 'Alphabet') {
                    var aValue = a.querySelector('.product-name').textContent.toLowerCase();
                    var bValue = b.querySelector('.product-name').textContent.toLowerCase();
                    return aValue.localeCompare(bValue);
                }
            });

            // Xóa các sản phẩm hiện tại
            productList.innerHTML = '';

            // Thêm lại sản phẩm đã được sắp xếp
            products.forEach(function(product) {
                productList.appendChild(product);
            });
        }
    });

</script>
