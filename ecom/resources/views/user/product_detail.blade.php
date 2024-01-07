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
                href="{{ route('product list with category', ['categorySlug' => getCategoryByProductID($thisProduct->productID)->categorySlug]) }}">{{ getCategoryByProductID($thisProduct->productID)->categoryName }}</a>
        </li>
        <li><a
                href="{{ route('productlist', ['categorySlug' => getCategoryByProductID($thisProduct->productID)->categorySlug, 'subCategorySlug' => getSubCategoryByProductID($thisProduct->productID)->subCategorySlug]) }}">{{ getSubCategoryByProductID($thisProduct->productID)->subCategoryName }}</a>
        </li>
        <li>{{ $thisProduct->productName }}</li>
    </ul>
</div>
<div class="product-view grid-product-view">
    <div class="product-img-container grid-image">
        <div class="small-image-container">
            <div class="small-image">
                <img src="{{ asset($thisProduct->productSideImage1) }}" alt="" width="150" height="150">
            </div>
            <div class="small-image">
                <img src="{{ asset($thisProduct->productSideImage2) }}" alt="" width="150" height="150">
            </div>
            <div class="small-image">
                <img src="{{ asset($thisProduct->productSideImage3) }}" alt="" width="150" height="150">
            </div>
        </div>
        <div class="large-image">
            <img src="{{ asset($thisProduct->productImage) }}" alt="" width="450" height="450">
        </div>
    </div>
    <div class="product-info-container">
        <div class="product-brand">
            <h3>{{ $thisProduct->productBrandName }}</h3>
        </div>
        <br>
        <div class="product-name">
            <h1>{{ $thisProduct->productName }}</h1>
        </div>
        <div class="product-price">
            <strong class="left discounted-price">{{ formatCurrency($thisProduct->productDiscountPrice) }}</strong>
            <span class="right real-price">{{ formatCurrency($thisProduct->productOriginalPrice) }}</span>
        </div>
        <br><br>
        <div class="product-variant">
            <div class="product-amount">
                <h5>Số lượng: </h5>
                <input type="number" id="quantityPick" min="1" value="1">
            </div>
            <div class="btn-product">
                <button class="btn-add-to-cart" id="addToCartBtn"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ
                    hàng</button>
                <button class="btn-buy-now" id="buy-now">Mua ngay</button>
            </div>
        </div>
    </div>
</div>

<div class="product-detail-information product-box">
    <div class="product-detail-information-title width-common">
        <h2 class="section-txt-title">Thông tin sản phẩm</h2>
    </div>
    <div class="product-detail-information-content">
        <p>{{ $thisProduct->productInfo }}</p>
    </div>
</div>

<div class="product-detail-parameter product-box">
    <div class="product-detail-parameter-title">
        <h2 class="section-txt-title">Thông số sản phẩm</h2>
    </div>
    <table class="parameter-detail">
        <tr>
            <th>Mã sản phẩm</th>
            <td>{{ $thisProduct->productID }}</td>
        </tr>
        <tr>
            <th>Barcode</th>
            <td>{{ $thisProduct->productBarcode }}</td>
        </tr>
        <tr>
            <th>Thương hiệu</th>
            <td>{{ $thisProduct->productBrandName }}</td>
        </tr>
        <tr>
            <th>Xuất xứ</th>
            <td>Nhật Bản</td>
        </tr>
        <tr>
            <th>Danh mục sản phẩm</th>
            <td>{{ $thisProduct->productCategoryName }}</td>
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
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $averageRating)
                    <i class="fa-solid fa-star checked"></i>
                @else
                    <i class="fa-solid fa-star"></i>
                @endif
            @endfor
            <hr>

            <!-- Display rating distribution -->
            <div class="row">
                @foreach ($ratingDistribution as $distribution)
                    <div class="side-star">
                        <div>{{ $distribution['rating'] }} sao</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar bar-{{ $distribution['rating'] }}"
                                style="width: {{ $distribution['count'] * 1 }}%"></div>
                        </div>
                    </div>
                    <div class="side-star txt-right">
                        <div>{{ $distribution['count'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        @auth
            <div class="col-md-8">
                <div class="row">
                    <form action="{{ route('storerating') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="productID" name="productID"
                            value="{{ $thisProduct->productID }}" />
                        <br> <br>
                        <h3 class="h4 pb-3">Để lại đánh giá</h3>
                        @auth
                            <div class="form-group col-md-6 mb-3" style="display: none;">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="userName" id="name" placeholder="Name"
                                    readonly value="{{ Auth::user()->name }}">
                            </div>
                        @endauth
                        @guest
                            <div class="form-group col-md-6 mb-3" style="display: none;">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="userName" id="name" placeholder="Name"
                                    readonly value="">
                            </div>
                        @endguest
                </div>
                <div class="form-group mb-3">
                    <label for="rating">Đánh giá</label>
                    <br>
                    <div class="rating" style="width: 10rem">
                        <input id="rating-5" type="radio" name="rating" value="5" /><label for="rating-5"><i
                                class="fas fa-3x fa-star"></i></label>
                        <input id="rating-4" type="radio" name="rating" value="4" /><label for="rating-4"><i
                                class="fas fa-3x fa-star"></i></label>
                        <input id="rating-3" type="radio" name="rating" value="3" /><label for="rating-3"><i
                                class="fas fa-3x fa-star"></i></label>
                        <input id="rating-2" type="radio" name="rating" value="2" /><label for="rating-2"><i
                                class="fas fa-3x fa-star"></i></label>
                        <input id="rating-1" type="radio" name="rating" value="1" /><label for="rating-1"><i
                                class="fas fa-3x fa-star"></i></label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Đánh giá chân thật</label>
                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="10"
                        placeholder="How was your overall experience?"></textarea>
                </div>
                <div>
                    <button class="btn btn-dark">Submit</button>
                </div>
                </form>

            </div>
        @endauth
    </div>
    <style>
        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            color: #ddd;
            /* Personal choice */
            font-size: 8px;
            margin-left: -15px;
        }

        .rating input {
            display: none;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked+label,
        .rating input:checked+label~label {
            color: #ffc107;
            /* Personal color choice. Lifted from Bootstrap 4 */
            font-size: 8px;
        }


        .front-stars,
        .back-stars,
        .star-rating {
            display: flex;
        }

        .star-rating {
            align-items: left;
            font-size: 1.5em;
            justify-content: left;
            margin-left: -5px;
        }

        .back-stars {
            color: #CCC;
            position: relative;
        }

        .front-stars {
            color: #FFBC0B;
            overflow: hidden;
            position: absolute;
            top: 0;
            transition: all 0.5s;
        }


        .percent {
            color: #bb5252;
            font-size: 1.5em;
        }
    </style>
    <br>
    <span>Đánh giá nổi bật</span>
    @foreach ($latestRatings as $rating)
        <div class="review-detail">
            <div class="rating-star">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $rating->rating)
                        <i class="fa-solid fa-star checked"></i>
                    @else
                        <i class="fa-solid fa-star"></i>
                    @endif
                @endfor
            </div>
            <div class="name-rating-customer">{{ $rating->userName }}</div>
            <div class="review-content">
                {{ str_ireplace(
                    ['ngu', 'cặc', 'lồn', 'đụ', 'má', 'địt', 'cc', 'cl', 'dm', 'vl'],
                    ['****', '****', '****', '****', '****', '****', '****', '****', '****', '****'],
                    $rating->comment,
                ) }}
            </div>
            <div class="review-date txt-12">
                {{ $rating->created_at->format('d/m/Y') }}
            </div>
        </div>
    @endforeach
</div>
</div>

<div class="relative-products-4 product-box">
    <div class="relative-products-4-title">
        <h2 class="section-txt-title">Sản phẩm tương tự</h2>
    </div>
    <div class="suggested-product-content grid-4-col">
        @foreach ($similarProducts as $product)
            <div class="preview-product">
                <div class="product-ping width-common relative">
                    <a href="{{ route('detail product', ['categorySlug' => getCategoryByProductID($product->productID)->categorySlug, 'subCategorySlug' => getSubCategoryByProductID($product->productID)->subCategorySlug, 'productSlug' => $product->productSlug]) }}"
                        class="image-common relative">
                        <div class="product-img sale">
                            <img src="{{ asset($product->productImage) }}" alt="" height="200"
                                width="200">
                            <span
                                class="sale-percent">{{ (1 - round($product->productDiscountPrice / $product->productOriginalPrice, 2)) * 100 . '%' }}</span>
                        </div>
                        <div class="product-info">
                            <div class="width-common price-block">
                                <strong
                                    class="discount-price txt-16">{{ formatCurrency($product->productDiscountPrice) }}
                                    &#8363;</strong>
                                <span class="original-price txt-12 right">{{ $product->productOriginalPrice }}
                                    &#8363;</span>
                            </div>
                            <div class="product-name-block">
                                <h3 class="width-common pr-name sp-bottom-5">
                                    <div class="product-name cyan-link">{{ $product->productName }}</div>
                                </h3>
                            </div>
                            <div class="sold-number">
                                <span class="sold-product-number">Đã bán: 100</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('user.layouts.template_footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>

<script>
    $('#addToCartBtn').click(function() {
        var quantity = document.getElementById('quantityPick').value;
        addToCart({{ $thisProduct->productID }}, quantity);
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Đã thêm vào giỏ hàng',
            showConfirmButton: false,
            timer: 1500
        });


    });
    $('#buy-now').click(function() {
        var quantity = document.getElementById('quantityPick').value;
        addToCart({{ $thisProduct->productID }}, quantity);
        let timerInterval;
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Đã thêm vào giỏ hàng',
            showConfirmButton: false,
            timer: 1500,
        });

        window.location.href = "{{ route('cart') }}";
    });

    function addToCart(productID, quantity) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('add to cart') }}",
            type: "POST",
            data: {
                "productID": productID,
                "quantity": quantity
            },
            datatype: "JSON",
            success: function(response) {
                if (response.status == 200) {} else {
                    // alert(response.message);
                }
            }
        });
    }
</script>
