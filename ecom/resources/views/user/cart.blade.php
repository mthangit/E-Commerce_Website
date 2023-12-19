@include('user.layouts.template_header_logged')
<div class="page-navigation">
    <ul class="breadcrumb">
        @auth
            <li><a href="{{route('userdashboard')}}">Trang chủ</a></li>
        @endauth
        @guest
            <li><a href="/">Trang chủ</a></li>
        @endguest
        <li><a href="">Giỏ hàng</a></li>
    </ul>
</div>

<section class="h-100">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 txt-cyan hard">Giỏ hàng</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">{{count($products)}} sản phẩm</span></p>
                    </div>
                </div>
                <?php
                    $totalPrice = 0;
                    ?>
                @foreach($products as $product)
                    <?php
                        $totalPrice += ($product->price * $product->qty);
                        $inputId = 'form' . $product->id;
                        ?>
                    <div class="card1 rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img
                                        src="{{asset(getImageProductByProductID($product->id)->productImage)}}"
                                        class="img-fluid rounded-3" alt="">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="fw-normal mb-2">{{$product->name}}</p>
                                  <!-- <p><span class="text-muted">Loại: </span>60ml</p> -->
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <button class="btn btn-link px-2 sub" data-rowID="{{$product->rowId}}">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input id="{{$inputId}}" min="1" name="quantity" value="{{$product->qty}}"  type="number"
                                           class="form-control form-control-sm quantity-input" />
                                    <button class="btn btn-link px-2 add" data-rowID="{{$product->rowId}}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0 txt-16">{{formatCurrency($product->price * $product->qty)}} &#8363;</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="{{route('delete cart', ['rowID'=>$product->rowId])}}" class="text-danger" id="delete-item" data-rowid="{{ $product->rowId }}"><i class="fas fa-trash fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="card1">
                    <div class="card-body">
                        <div class="total mb-lg-5">
                            <span class="tb-header left">Tạm tính</span>
                            <span class="tb-header right txt-18 txt-orange">{{formatCurrency($totalPrice)}} &#8363;</span>
                        </div>
                        <a href="{{route('payment')}}"><button type="button" class="btn btn-block btn-lg order text-uppercase">Tiến hành thanh toán</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="continue-shopping-container">
        <a href="" class="continue cyan-link text-white"><i class="fa-solid fa-caret-left"></i> Tiếp tục mua hàng</a>
        <hr>
    </div>
</section>
@include('user.layouts.template_footer')
<script>
    $('.sub').click(function () {
        var rowID = $(this).attr('data-rowID');
        var inputElement = $(this).parent().find('.quantity-input');
        var qty = parseInt(inputElement.val());
        if(qty > 1) {
            inputElement.val(qty - 1);
        }
        var newQty = parseInt(inputElement.val());
        updateCart(rowID, newQty);
    });
    $('.add').click(function () {
        var rowID = $(this).attr('data-rowID');
        var inputElement = $(this).parent().find('.quantity-input');
        var qty = parseInt(inputElement.val());
        if(qty < 10) {
            inputElement.val(qty + 1);
        }
        var newQty = parseInt(inputElement.val());
        updateCart(rowID, newQty);
    });
    function updateCart(rowID, qty) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("update cart")}}',
            method: 'POST',
            data: {
                rowID: rowID,
                qty: qty
            },
            datatype: 'json',
            success: function (response) {
                if(response.status === true) {
                    window.location.href = '{{route("cart")}}';
                }
            }

        });
    }
</script>

