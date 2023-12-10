@include('user.layouts.template_header_logged')

<div class="page-navigation">
        <ul class="breadcrumb">
            @auth
                <li><a href="{{route('userdashboard')}}">Trang chủ</a></li>
            @endauth
            @guest
                <li><a href="/">Trang chủ</a></li>
            @endguest
            <li><a href="{{route('product list with category', ['categorySlug'=>getCategoryByProductID($thisProduct->productID)->categorySlug])}}">{{getCategoryByProductID($thisProduct->productID)->categoryName}}</a></li>
            <li><a href="{{route('productlist', ['categorySlug'=>getCategoryByProductID($thisProduct->productID)->categorySlug, 'subCategorySlug'=>getSubCategoryByProductID($thisProduct->productID)->subCategorySlug])}}">{{getSubCategoryByProductID($thisProduct->productID)->subCategoryName}}</a></li>
            <li>{{$thisProduct->productName}}</li>
        </ul>
    </div>
    <div class="product-view grid-product-view">
        <div class="product-img-container grid-image">
            <div class="small-image-container">
                <div class="small-image">
                    <img src="{{asset($thisProduct->productImage)}}" alt="" width="150" height="150">
                </div>
                <div class="small-image">
                    <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" width="150" height="150">
                </div>
                <div class="small-image">
                    <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" width="150" height="150">
                </div>
            </div>
            <div class="large-image">
                <img src="{{asset($thisProduct->productImage)}}" alt="" width="450" height="450">
            </div>
        </div>
        <div class="product-info-container">
            <div class="product-brand">
                <h3>Anessa</h3>
            </div>
            <div class="product-name">
                <h1>{{$thisProduct->productName}}</h1>
            </div>
            <div class="product-price">
                <strong class="left discounted-price">{{$thisProduct->productDiscountPrice}}</strong>
                <span class="right real-price">{{$thisProduct->productOriginalPrice}}</span>
            </div>
            <br><br>
            <div class="product-variant">
{{--                <div class="product-variant-title">--}}
{{--                    <div class="variant-description"></div>--}}
{{--                </div>--}}
                <div class="product-amount">
                    <h5>Số lượng: </h5>
                    <input type="number" id="quantityPick" min="1" value="1">
                </div>
                <div class="btn-product">
                    <button class="btn-add-to-cart" id="addToCartBtn"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
                    <button class="btn-buy-now">Mua ngay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="product-detail-information product-box">
        <div class="product-detail-information-title width-common">
            <h2 class="section-txt-title">Thông tin sản phẩm</h2>
        </div>
        <div class="product-detail-information-content">
            <p>{{$thisProduct->productInfo}}</p>
        </div>
    </div>

    <div class="product-detail-parameter product-box">
        <div class="product-detail-parameter-title">
            <h2 class="section-txt-title">Thông số sản phẩm</h2>
        </div>
        <table class="parameter-detail">
            <tr>
                <th>Mã sản phẩm</th>
                <td>422206430</td>
            </tr>
            <tr>
                <th>Barcode</th>
                <td>4909978120757</td>
            </tr>
            <tr>
                <th>Thương hiệu</th>
                <td>Anessa</td>
            </tr>
            <tr>
                <th>Xuất xứ</th>
                <td>Nhật Bản</td>
            </tr>
            <tr>
                <th>Danh mục sản phẩm</th>
                <td>Kem chống nắng</td>
            </tr>
        </table>
    </div>

    <div class="product-review-customer product-box">
        <div class="product-review-customer-title">
            <h2 class="section-txt-title">Đánh giá</h2>
        </div>
        <div class="product-review-customer-detail">
            <div class="review-product-average">
                <span>Đánh giá trung bình </span>
                <i class="fa-solid fa-star checked"></i>
                <i class="fa-solid fa-star checked"></i>
                <i class="fa-solid fa-star checked"></i>
                <i class="fa-solid fa-star checked"></i>
                <i class="fa-solid fa-star"></i>
                <hr>
                <div class="row">
                    <div class="side-star">
                      <div>5 sao</div>
                    </div>
                    <div class="middle">
                      <div class="bar-container">
                        <div class="bar-5"></div>
                      </div>
                    </div>
                    <div class="side-star txt-right">
                      <div>150</div>
                    </div>
                    <div class="side-star">
                      <div>4 sao</div>
                    </div>
                    <div class="middle">
                      <div class="bar-container">
                        <div class="bar-4"></div>
                      </div>
                    </div>
                    <div class="side-star txt-right">
                      <div>63</div>
                    </div>
                    <div class="side-star">
                      <div>3 sao</div>
                    </div>
                    <div class="middle">
                      <div class="bar-container">
                        <div class="bar-3"></div>
                      </div>
                    </div>
                    <div class="side-star txt-right">
                      <div>15</div>
                    </div>
                    <div class="side-star">
                      <div>2 sao</div>
                    </div>
                    <div class="middle">
                      <div class="bar-container">
                        <div class="bar-2"></div>
                      </div>
                    </div>
                    <div class="side-star txt-right">
                      <div>6</div>
                    </div>
                    <div class="side-star">
                      <div>1 sao</div>
                    </div>
                    <div class="middle">
                      <div class="bar-container">
                        <div class="bar-1"></div>
                      </div>
                    </div>
                    <div class="side-star txt-right">
                      <div>20</div>
                    </div>
                  </div>
            </div>
            <br>
            <span>Đánh giá nổi bật</span>
            <div class="review-detail">
                <div class="rating-star">
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="name-rating-customer">Nguyễn Nguyễn Nguyễn</div>
                <div class="review-content">
                    Sản phẩm kiềm dầu tốt, che phủ chắc chắn, không bị nâng tông quá nhiều.
                </div>
                <div class="review-date txt-12">
                    17/04/2023
                </div>
            </div>
            <div class="review-detail">
                <div class="rating-star">
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="name-rating-customer">Nguyễn Nguyễn Nguyễn</div>
                <div class="review-content">
                    Sản phẩm kiềm dầu tốt, che phủ chắc chắn, không bị nâng tông quá nhiều.
                </div>
                <div class="review-date txt-12">
                    17/04/2023
                </div>
            </div>
            <div class="review-detail">
                <div class="rating-star">
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="name-rating-customer">Nguyễn Nguyễn Nguyễn</div>
                <div class="review-content">
                    Sản phẩm kiềm dầu tốt, che phủ chắc chắn, không bị nâng tông quá nhiều.
                </div>
                <div class="review-date txt-12">
                    17/04/2023
                </div>
            </div>
        </div>
    </div>

    <div class="relative-products-4 product-box">
        <div class="relative-products-4-title">
            <h2 class="section-txt-title">Sản phẩm tương tự</h2>
        </div>
        <div class="suggested-product-content grid-4-col">
            <div class="preview-product">
                <div class="product-ping width-common relative">
                    <a href="" class="image-common relative">
                        <div class="product-img sale">
                            <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" height="200" width="200">
                            <span class="sale-percent">50%</span>
                        </div>
                        <div class="product-info">
                            <div class="width-common price-block">
                                <strong class="discount-price txt-16">350.000 &#8363;</strong>
                                <span class="original-price txt-12 right">700.000 &#8363;</span>
                            </div>
                            <div class="product-name-block">
                                <h3 class="width-common pr-name sp-bottom-5">
                                    <div class="product-name cyan-link">Sữa Chống Nắng Anessa Dưỡng Da Kiềm Dầu 20ml</div>
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
            <div class="preview-product">
                <div class="product-ping width-common relative">
                    <a href="" class="image-common relative">
                        <div class="product-img sale">
                            <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" height="200" width="200">
                            <span class="sale-percent">50%</span>
                        </div>
                        <div class="product-info">
                            <div class="width-common price-block">
                                <strong class="discount-price txt-16">350.000 &#8363;</strong>
                                <span class="original-price txt-12 right">700.000 &#8363;</span>
                            </div>
                            <div class="product-name-block">
                                <h3 class="width-common pr-name sp-bottom-5">
                                    <div class="product-name cyan-link">Sữa Chống Nắng Anessa Dưỡng Da Kiềm Dầu 20ml</div>
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
            <div class="preview-product">
                <div class="product-ping width-common relative">
                    <a href="" class="image-common relative">
                        <div class="product-img sale">
                            <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" height="200" width="200">
                            <span class="sale-percent">50%</span>
                        </div>
                        <div class="product-info">
                            <div class="width-common price-block">
                                <strong class="discount-price txt-16">350.000 &#8363;</strong>
                                <span class="original-price txt-12 right">700.000 &#8363;</span>
                            </div>
                            <div class="product-name-block">
                                <h3 class="width-common pr-name sp-bottom-5">
                                    <div class="product-name cyan-link">Sữa Chống Nắng Anessa Dưỡng Da Kiềm Dầu 20ml</div>
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
            <div class="preview-product">
                <div class="product-ping width-common relative">
                    <a href="" class="image-common relative">
                        <div class="product-img sale">
                            <img src="https://media.hcdn.vn/wysiwyg/HaNguyen1/sua-chong-nang-anessa-duong-da-kiem-dau-bao-ve-hoan-hao-1.jpg" alt="" height="200" width="200">
                            <span class="sale-percent">50%</span>
                        </div>
                        <div class="product-info">
                            <div class="width-common price-block">
                                <strong class="discount-price txt-16">350.000 &#8363;</strong>
                                <span class="original-price txt-12 right">700.000 &#8363;</span>
                            </div>
                            <div class="product-name-block">
                                <h3 class="width-common pr-name sp-bottom-5">
                                    <div class="product-name cyan-link">Sữa Chống Nắng Anessa Dưỡng Da Kiềm Dầu 20ml</div>
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
        </div>
    </div>


@include('user.layouts.template_footer')

<script>
    $('#addToCartBtn').click(function () {
        var quantity = document.getElementById('quantityPick').value;
        addToCart({{$thisProduct->productID}}, quantity);
    });
    function addToCart(productID, quantity) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('add to cart')}}",
            type: "POST",
            data: {
                "productID": productID,
                "quantity": quantity
            },
            datatype: "JSON",
            success: function (response) {
                if (response.status == 200) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>
