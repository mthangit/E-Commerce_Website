@include('user.layouts.template_header_logged')
{{-- <div class="header-wrapper cyan fixed" > --}}
{{--    <div class="header-container flex"> --}}
{{--        <div class="logo-site"> --}}
{{--            <a href="/" class="logo"> --}}
{{--                <img src="assets/logo.svg" alt="logo"> --}}
{{--            </a> --}}
{{--        </div> --}}
{{--        <div class="page-header"> --}}
{{--            <h2 class="section-txt-title" style="color: white;">Thanh toán</h2> --}}
{{--        </div> --}}
{{--    </div> --}}
{{-- </div> --}}

<div class="delivery-info payment-block" style="margin-top: 30px;">
    <div id="errorInfo" class="alert alert-danger alert-dismissible fade show" role="alert" disabled>
        <strong>Error!</strong> Nhập đầy đủ thông tin.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="delivery-info-header payment-block-header">
        <div class="left">
            <h4 class="txt-cyan txt-18">THÔNG TIN NHẬN HÀNG</h4>
        </div>
        <div class="right">
            <a href="" class="cyan-link" style="color: rgb(128,128,128);">Chỉnh sửa</a>
        </div>
    </div>
    <div class="delivery-content" style="margin-top: -1px;">
        <p><span class="txt-bold" id="orderName">{{ $info->customerName }}</span> - <span
                id="orderPhone">{{ $info->customerPhone }}</span></p>
        <h4 class="txt-cyan txt-18">Địa chỉ nhận hàng</h4>
        <p id="orderAddress">{{ $info->customerAddress }}</p>
    </div>
    <div class="edit-delivery-content ">
        <div class="address-edit" style="display: flex; justify-content: space-between; width: 100%">
            <br>
            <div class="col-md-4">
                <h6 class="txt-black-italy txt-15">Tỉnh/Thành phố</h6>
                <select class="form-select form-select-sm mb-3 form-control" id="city"
                    aria-label=".form-select-sm">
                    <option value="" selected>Chọn tỉnh thành</option>
                </select>
            </div>
            <div class="col-md-4">
                <h6 class="txt-black-italy txt-15">Quận/huyện</h6>
                <select class="form-select form-select-sm mb-3  form-control" id="district"
                    aria-label=".form-select-sm">
                    <option value="" selected>Chọn quận huyện</option>
                </select>
            </div>
            <div class="col-md-4">
                <h6 class="txt-black-italy txt-15">Phường/xã</h6>
                <select class="form-select form-select-sm mb-3 form-control" id="ward"
                    aria-label=".form-select-sm">
                    <option value="" selected>Chọn phường xã</option>
                </select>
            </div>
            <br>
        </div>
        <div class="address-edit" style="display: flex; justify-content: space-between; width: 100%">
            <div class="col-md-8">
                <h6 class="txt-black-italy txt-15">Số nhà, tên đường, tên ấp</h6>
                <input class="form-control" type="text" name="address" id="address"
                    placeholder="Nhập số nhà, tên đường" style="width: 100%; margin-bottom: 10px; margin-right: 10px">
            </div>
            <div class="col-md-4">
                <div id="errorPhone" class="alert alert-warning alert-dismissible fade show small-alert" role="alert"
                    disabled>
                    <strong>Error!</strong> Sai định dạng số điện thoại.
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h6 class="txt-black-italy txt-15">Số điện thoại</h6>
                <input class="form-control" type="text" name="phone" id="phone"
                    placeholder="Nhập số điện thoại" style="width: 100%; margin-bottom: 10px; margin-right: 10px">
            </div>
        </div>
        <div class="col-md-3">
            <div class="address-edit d-flex justify-content-between w-100">
                <button class="btn btn-primary" id="btn-save"> Lưu lại</button>
            </div>
        </div>

    </div>

    <br>

    <style>
        #errorInfo {
            display: none;
        }

        .small-alert {
            padding: 0.75rem 1.25rem;
            font-size: 0.9rem;
        }

        /* Đặt các select thành kiểu inline-block */
        .edit-delivery-content select {
            display: flex;
            margin-right: 10px;
            /* Điều chỉnh giá trị theo nhu cầu của bạn */
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 15px;
            overflow: hidden;
            height: 75px;
            border: 0.5px solid #5d5d5f;
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .payment-option img {
            height: 100%;
            object-fit: cover;
        }

        .payment-option-text {
            padding-left: 10px;
            display: flex;
            text-align: center;
            font-weight: bold;
        }

        .payment-option-text p {
            margin: 0;

        }


        .payment-option:hover {
            background-color: #fffcfc;
            /* Màu nền khi hover */
            border-color: #007bff;
            /* Viền khi hover */
            box-shadow: 0px 0px 15px rgba(9, 8, 8, 0.1);
            /* Bóng đổ khi hover */
        }

        .selected {
            /* Màu nền khi được chọn */
            color: #020202;
            border: 2px solid #007bff;
            box-shadow: 0px 0px 15px rgba(58, 58, 58, 0.1);
            transform: translateY(-2px);

        }

        .payment-option img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .txt-black-italy {
            font-style: italic;
            color: black
        }
    </style>

</div>
<div class="product-delivery-info payment-block">
    <div class="product-delivery-header payment-block-header">
        <h4 class="txt-cyan txt-18">Đơn hàng</h4>
    </div>
    <div class="product-delivery-content">
        <table class="tb-payment-product">
            <thead>
                <tr>
                    <th style="text-align: left;">Sản phẩm</th>
                    <th style="text-align: center;">Đơn giá</th>
                    <th style="text-align: center;">Số lượng</th>
                    <th style="text-align: center;">Thành tiền</th>
                </tr>
            </thead>
            <?php
            $totalPrice = 0;
            ?>
            @foreach ($order_list as $order_detail)
                <?php
                $totalPrice += $order_detail->price * $order_detail->qty;
                ?>
                <tbody class="tb-product">
                    <tr>
                        <td style="text-align: left;">
                            <img src="{{ asset(getImageProductByProductID($order_detail->id)->productImage) }}"
                                alt="" style="width: 100px; height: 50px; margin-right: 10px;">
                            {{ $order_detail->name }}
                        </td>
                        <td style="text-align: center;">{{ formatCurrency($order_detail->price) }} &#8363;</td>
                        <td style="text-align: center;">{{ $order_detail->qty }}</td>
                        <td style="font-weight: bold;text-align: center;">
                            {{ formatCurrency($order_detail->price * $order_detail->qty) }}&#8363;</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>

<div class="discount-info payment-block">
    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert" disabled>
        <strong>Error!</strong> Mã giảm giá không tồn tại.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="discount-info-header payment-block-header">
        <h4 class="txt-cyan txt-18">Mã giảm giá</h4>
    </div>
    <div class="discount-pick" style="margin-top: -5px;">
        <form action="javascript:void(0)" id="form-voucher">
            <input type="text" name="discount-voucher" id="discount-voucher" placeholder="Nhập mã giảm giá">
            <button class="txt-uppercase order" id="btn-apply-voucher">Áp dụng</button>
            <br>
            <span style="font-style: italic; color: rgb(128,128,128); font-size: 13px; margin-left: 695px;"><span
                    style="text-decoration: underline;">Lưu ý:</span> Chỉ được áp dụng <strong>tối đa</strong> 1 mã
                giảm giá.</span>
        </form>
    </div>
    <div class="discount-detail">
        <strong>Thông tin mã giảm giá</strong><br>
        <table id="discount-detail-info">
            <tr>
                <th>Tên mã giảm giá</th>
                <td>Giảm 10.000&#8363; Đơn Tối Thiểu 0&#8363;</td>
            </tr>
            <tr>
                <th>Code mã giảm giá</th>
                <td>DTT0</td>
            </tr>
            <tr>
                <th>Thời hạn sử dụng</th>
                <td>13/112023 00:00 - 15/11/2023 23:58</td>
            </tr>
            <tr>
                <th>Điều kiện sử dụng</th>
                <td>
                    <ul>
                        <li>
                            Sử dụng mã giảm phí vận chuyển (tối đa 10.000 &#8363;) cho đơn hàng từ 0Đ khi mua hàng
                            trên
                            PING Cosmetics.
                        </li>
                        <li>
                            Áp dụng tất cả các hình thức thanh toán.
                        </li>
                        <li>
                            Số lượt sử dụng có hạn, chương trình và mã có thể kết thúc khi hết lượt ưu đãi hoặc khi
                            hết
                            hạn ưu đãi, tuỳ điều kiện nào đến trước.
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="payment-total-info payment-block">
    <div id="errorAlertPaymentMethod" class="alert alert-danger alert-dismissible fade show" role="alert" disabled>
        <strong>Error!</strong> Vui lòng chọn phương thức thanh toán.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="payment-total-header payment-block-header">
        <h4 class="txt-cyan txt-18">Thành tiền</h4>
    </div>
    <div class="payment-total-detail grid-2-col">
        <div class="payment-left">
            <div class="payment-method">
                <strong>Lựa chọn phương thức thanh toán: </strong>

                <br>
                <div class="row" style="padding-top: 10px; padding-bottom: 10px">
                    <div class="col-md-4">
                        <div class="payment-option" onclick="selectPaymentMethod('MOMO')">
                            <div class="payment-option-img">
                                <img src="{{ asset('assets/momo.svg') }}" alt="MOMO" class="img-fluid">
                            </div>
                            <div class="payment-option-text">
                                <p>Thanh toán qua MoMo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="payment-option" onclick="selectPaymentMethod('VNPAY')">
                            <div class="payment-option-img">
                                <img src="{{ asset('assets/VNPAY-QR-1.png') }}" alt="VNPAY" class="img-fluid">
                            </div>
                            <div class="payment-option-text">
                                <p>Thanh toán qua VNPAY-QR</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="payment-option" onclick="selectPaymentMethod('COD')">
                            <div class="payment-option-img">
                                <img src="{{ asset('assets/cod-logo.png') }}" alt="COD" class="img-fluid">
                            </div>

                            <div class="payment-option-text">
                                <p>COD - Thanh toán khi nhận hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="payment-note">
                <strong>Lưu ý:</strong><br>
                <ul>
                    <li>Thành tiền đã bao gồm VAT, phí đóng gói, phí vận chuyển và các chi phí khác vui lòng xem <a
                            href="{{ route('deliverypolicy') }}" class="cyan-link txt-bold">chính sách vận
                            chuyển</a>.</li>
                    <li>Nếu có nhu cầu đổi trả hàng, vui lòng xem <a href="{{ route('returnpolicy') }}"
                            class="cyan-link txt-bold">chính
                            sách đổi trả hàng</a> hoặc liên hệ hotline để được hướng dẫn chi tiết.</li>
                </ul>
            </div>
        </div>
        <div class="payment-right">
            <div class="payment-summary">
                <div class="first-summary">
                    <span class="left">Tạm tính</span>
                    <span id = "tempTotal" hidden>{{ $totalPrice }}</span>
                    <span class="right" id="totalPrice">{{ formatCurrency($totalPrice) }} &#8363;</span>
                </div>
                <br>
                <div class="shipping-cost">
                    <span class="left">Phí vận chuyển</span>
                    <?php
                    if ($totalPrice > 250000) {
                        $shippingFee = 0;
                    } else {
                        $shippingFee = 30000;
                    }
                    ?>
                    <span class="right">{{ formatCurrency($shippingFee) }} &#8363;</span>
                </div>
                <br>
                <div class="discount-money">
                    <span class="left">Giảm giá</span>
                    <span class="right" id="giamgia">0 &#8363;</span>
                </div><br>
                <hr>
                <div class="final-total-money">
                    <span class="txt-orange txt-bold txt-18 left">Thành tiền</span>

                    <span class="txt-orange txt-bold txt-18 right"name="totalPrice"
                        id="thanhtien">{{ formatCurrency($totalPrice + $shippingFee) }} &#8363;</span>
                </div><br>
                <form method="POST" id="form-finish">
                    <button type="button" class="order txt-uppercase" id="btn-finish" name="btn-finish">Đặt
                        hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="return">
    <a href="{{ route('cart') }}" class="cyan-link txt-14">Quay lại</a>
    <hr style="color: var(--gray);">
</div>
@include('user.layouts.template_footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var discountPrice = 0;
    var discountValidCode = '';
    var totalPrice = parseInt(document.getElementById('tempTotal').innerText);
    var payment = "";
    var officialTotalPrice = totalPrice;
    var shippingFee = {{ $shippingFee }};
    var grandPrice = officialTotalPrice + shippingFee;

    var formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        minimumFractionDigits: 0,
    });


    function selectPaymentMethod(method) {
        // Lấy tất cả các phần tử có class 'payment-option'
        var paymentOptions = document.querySelectorAll('.payment-option');
        payment = method;
        // Bỏ chọn tất cả các phương thức thanh toán
        paymentOptions.forEach(function(option) {
            option.classList.remove('selected');
        });

        // Chọn phương thức thanh toán được click
        var selectedOption = document.querySelector('.payment-option[onclick="selectPaymentMethod(\'' + method +
            '\')"]');
        selectedOption.classList.add('selected');
    }

    $(document).ready(function() {
        // Initially hide the discount block and error message
        $('#errorInfo').hide();

        $('#errorAlertPaymentMethod').hide();
        $('.discount-detail').hide();
        $('#errorAlert').hide();
        $('#errorPhone').hide();
        $('#btn-apply-voucher').click(function() {

            var voucher = $('#discount-voucher').val();

            if (voucher == '') {
                $('#giamgia').html(`0 &#8363;`);
                $('#thanhtien').html(`${formatter.format(totalPrice + shippingFee)}`);
                $('.discount-detail').hide();
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('validate discount code') }}',
                type: 'POST',
                data: {
                    discountCode: voucher
                },
                success: function(response) {
                    if (response.isValid) {
                        var discount_valid = response.discount;
                        var discountType = discount_valid.discountType;
                        if (discountType == 'percent') {
                            discountPrice = totalPrice * discount_valid.discountAmount /
                                100;
                        } else {
                            discountPrice = discount_valid.discountAmount;
                        }
                        discountValidCode = discount_valid.discountCode;
                        // Assuming you have a response from the server after validating the discount code
                        var response = {
                            name: discount_valid.discountName,
                            price: discountPrice,
                            expiryDate: discount_valid.discountEnd,
                            description: discount_valid.discountDescription
                        };
                        // Fill the discount details in the table
                        $('#discount-detail-info').html(`
                            <tr>
                                <th>Tên mã giảm giá</th>
                                <td>${response.name}</td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td>${response.description}</td>
                            </tr>
                            <tr>
                                <th>Thời hạn sử dụng</th>
                                <td>${response.expiryDate}</td>
                            </tr>
                            <tr>
                                <th>Số tiền giảm giá</th>
                                <td>${formatter.format(response.price)}</td>
                            </tr>
                        `);
                        // Update the discount price
                        $('#giamgia').html(`${ formatter.format(discountPrice)}`);
                        // Update the thanhtien
                        $('#thanhtien').html(
                            `${formatter.format(totalPrice - discountPrice + shippingFee)}`
                            );

                        // Show the discount detail section
                        $('.discount-detail').show();
                        $('#errorAlert').hide();
                        grandPrice = totalPrice - discountPrice;
                    } else {
                        $('#giamgia').html(`0 &#8363;`);
                        $('#thanhtien').html(
                            `${formatter.format(totalPrice + shippingFee)}`);
                        $('.discount-detail').hide();
                        $('#errorAlert').show();
                        grandPrice = totalPrice;
                    }
                },
                error: function(error) {
                    // Xử lý lỗi
                    console.error('Lỗi request:', error);
                }
            });
        })
    });

    document.getElementById('phone').addEventListener('input', function(e) {
        var input = e.target;
        var value = input.value;

        // Remove all non-digit characters
        value = value.replace(/\D/g, '');

        // Ensure the first digit is 0
        if (value.length > 0 && value[0] !== '0') {
            value = '0' + value;
        }

        // Limit to 10 digits
        if (value.length > 10) {
            value = value.slice(0, 10);
        }

        // Update the input value
        input.value = value;
    });

    document.getElementById('btn-finish').addEventListener('click', function() {
        // var payment = document.querySelector('input[name="payment"]:checked').value;

        if (payment === '') {
            $('#errorAlertPaymentMethod').show();
            return;
        }
        if (checkOrderInfo()) {
            var address = document.getElementById('orderAddress').innerText;
            var phone = document.getElementById('orderPhone').innerText;
            var name = document.getElementById('orderName').innerText;

            var payment_status = 'unpaid';

            var requestData = {
                totalPrice: (officialTotalPrice),
                paymentMethod: payment,
                discountValidCode: discountValidCode,
                orderCustomerName: name,
                orderPhone: phone,
                orderAddress: address,
                paymentStatus: payment_status,
            };

            if (payment == 'VNPAY') {
                storeOrderAndPayment(requestData, function(orderID) {
                    VnPay_Payment(orderID, grandPrice);
                }, function(error) {
                    console.error('Có lỗi xảy ra:', error);
                    // Xử lý lỗi nếu cần
                });
            } else if (payment == 'MOMO') {
                storeOrderAndPayment(requestData, function(orderID) {
                    console.log(orderID);
                    Momo_Payment(orderID, grandPrice);
                }, function(error) {
                    console.error('Có lỗi xảy ra:', error);
                    // Xử lý lỗi nếu cần
                });
            } else {
                storeOrder(requestData);
            }
        } else {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            $('#errorInfo').show();
        }
    });

    // send a request to server to store order and payment using form with POST method id form-finish

    function VnPay_Payment(orderID, totalPrice) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('vnpay.payment') }}',
            type: 'POST',
            data: {
                orderID: orderID,
                totalPrice: totalPrice,
            },
            success: function(response) {
                // alert('Đã chuyển sang trang thanh toán VNPAY');
                // console.log(response);
                window.location.href = response.data;
            },
        })
    }

    function Momo_Payment(orderID, totalPrice) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('momo.payment') }}',
            type: 'POST',
            data: {
                orderID: orderID,
                totalPrice: totalPrice
            },
            success: function(response) {
                // console.log(response);
                window.location.href = response.data;
            },
        })
    }

    function storeOrderAndPayment(requestData, successCallback, errorCallback) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('store.order') }}',
            type: 'POST',
            data: requestData,
            success: function(response) {
                successCallback(response.orderID);
            },
            error: function(error) {
                // Xử lý lỗi
                console.error('Lỗi request:', error);
                errorCallback(error);
            }
        });
    }

    // Sử dụng hàm

    function storeOrder(requestData) {
        // Gửi AJAX request
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('store.order') }}',
            type: 'POST',
            data: requestData,
            success: function(response) {
                window.location.href = /order-success/ + response.orderID;
            },
            error: function(error) {
                // Xử lý lỗi
                console.error('Lỗi request:', error);
            }
        });
    }
    // Đoạn mã JavaScript để lấy các phần tử DOM
    var editDeliveryContent = document.querySelector('.edit-delivery-content');
    var deliveryContent = document.querySelector('.delivery-content');
    var editLink = document.querySelector('.cyan-link');
    var saveButton = document.querySelector('#btn-save');
    var provinceID = 0;

    // Ẩn phần tử chỉnh sửa khi trang được tải
    editDeliveryContent.style.display = 'none';

    // Bắt sự kiện khi bấm vào nút "Chỉnh sửa"
    editLink.addEventListener('click', function(event) {
        event.preventDefault();
        // Ẩn phần tử thông tin hiển thị
        deliveryContent.style.display = 'none';
        // Hiển thị phần tử chỉnh sửa
        editDeliveryContent.style.display = 'block';
        saveButton.style.display = 'block';
        saveButton.addEventListener('click', luuThayDoi);

    });

    // Đoạn mã JavaScript để tạo các phần tử select và lấy dữ liệu
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");

    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };

    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }

        citis.onchange = function() {
            districts.length = 1;
            wards.length = 1;

            if (this.value != "") {
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    districts.options[districts.options.length] = new Option(k.Name, k.Id);
                }
            }


        };

        districts.onchange = function() {
            wards.length = 1;

            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };
    }

    function checkOrderInfo() {

        var address = document.getElementById('orderAddress').innerText;
        var phone = document.getElementById('orderPhone').innerText;
        var name = document.getElementById('orderName').innerText;

        // var selectedCity = citis.options[citis.selectedIndex].text;
        // var selectedDistrict = districts.options[districts.selectedIndex].text;
        // var selectedWard = wards.options[wards.selectedIndex].text;
        // var phone = document.getElementById("phone").value;
        // Lấy giá trị từ textarea

        // check if phone number is contain letter
        var phoneRegex = /[a-zA-Z]/g;
        if (phoneRegex.test(phone)) {
            return false;
        }

        var deliveryAddress = document.getElementById("address").value;

        if (address === '' || phone.length !== 10) {
            return false;
        } else {
            return true;
        }
    }
    // Đoạn mã JavaScript để xử lý sự kiện khi bấm nút "Lưu lại"
    function luuThayDoi() {
        // Lấy giá trị từ các phần tử select
        var selectedCity = citis.options[citis.selectedIndex].text;
        var selectedDistrict = districts.options[districts.selectedIndex].text;
        var selectedWard = wards.options[wards.selectedIndex].text;
        var phone = document.getElementById("phone").value;
        // Lấy giá trị từ textarea
        var deliveryAddress = document.getElementById("address").value;

        if (phone.length < 10 && phone.length > 0) {
            $('#errorPhone').show();
            return;
        }

        if (phone.length == 10) {
            document.getElementById("orderPhone").innerText = phone;
        }

        if (deliveryAddress === '' || selectedCity === 'Chọn tỉnh thành' || selectedDistrict === 'Chọn quận huyện' ||
            selectedWard === 'Chọn phường xã') {
            editDeliveryContent.style.display = 'none';
            // Hiển thị lại phần tử thông tin
            deliveryContent.style.display = 'block';
            saveButton.style.display = 'none';
        } else {
            // Cập nhật giá trị trong các phần tử HTML tương ứng
            document.getElementById("orderAddress").innerText = deliveryAddress + ', ' + selectedWard + ", " +
                selectedDistrict + ", " + selectedCity;
            document.getElementById("orderPhone").innerText = document.getElementById("phone").value;
            // Ẩn phần tử chỉnh sửa
            editDeliveryContent.style.display = 'none';
            // Hiển thị lại phần tử thông tin
            deliveryContent.style.display = 'block';
            saveButton.style.display = 'none';
        }
    }
</script>
