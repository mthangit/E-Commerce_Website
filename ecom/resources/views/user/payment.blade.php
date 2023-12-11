@include('user.layouts.template_header_logged')
{{--<div class="header-wrapper cyan fixed" >--}}
{{--    <div class="header-container flex">--}}
{{--        <div class="logo-site">--}}
{{--            <a href="/" class="logo">--}}
{{--                <img src="assets/logo.svg" alt="logo">--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="page-header">--}}
{{--            <h2 class="section-txt-title" style="color: white;">Thanh toán</h2>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="delivery-info payment-block" style="margin-top: 30px;">
    <div class="delivery-info-header payment-block-header">
        <div class="left">
            <h4 class="txt-cyan txt-18">Thông tin nhận hàng</h4>
        </div>
        <div class="right">
            <a href="" class="cyan-link" style="color: rgb(128,128,128);">Chỉnh sửa</a>
        </div>
    </div>
    <div class="delivery-content" style="margin-top: -1px;">
        <p><span class="txt-bold">{{$info->customerName}}</span> - <span id="orderPhone">{{$info->customerPhone}}</span></p>
        <p id="orderProvince" hidden>{{(getProvinceByProvinceID($info->customerProvinceID)->provinceName)}} </p>
        <p id="orderAddress">{{(getProvinceByProvinceID($info->customerProvinceID)->provinceName).', '.$info->customerAddress}}</p>
        <label for="delivery-note">Ghi chú <span style="font-style: italic;">(nếu có): </span></label>
        <textarea name="delivery-note" id="delivery-note" style="width: 100%; margin-top: 10px; height: 50px" placeholder="Nhập ghi chú"></textarea>
    </div>
    <div class="edit-delivery-content">
        <select class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm">
            <option value="" selected>Chọn tỉnh thành</option>
        </select>

        <select class="form-select form-select-sm mb-3" id="district" aria-label=".form-select-sm">
            <option value="" selected>Chọn quận huyện</option>
        </select>

        <select class="form-select form-select-sm" id="ward" aria-label=".form-select-sm">
            <option value="" selected>Chọn phường xã</option>
        </select>
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
            @foreach($order_list as $order_detail)
                <?php
                $totalPrice += ($order_detail->price * $order_detail->qty)
                    ?>
                <tbody class="tb-product">
                <tr>
                    <td style="text-align: left;">
                        <img src="{{asset(getImageProductByProductID($order_detail->id)->productImage)}}" alt="" style="width: 100px; height: 50px; margin-right: 10px;">
                        {{$order_detail->name}}
                    </td>
                    <td style="text-align: center;">{{$order_detail->price}} &#8363;</td>
                    <td style="text-align: center;">{{$order_detail->qty}}</td>
                    <td style="font-weight: bold;text-align: center;">{{$order_detail->price * $order_detail->qty }}&#8363;</td>
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
            <span style="font-style: italic; color: rgb(128,128,128); font-size: 13px; margin-left: 695px;"><span style="text-decoration: underline;">Lưu ý:</span> Chỉ được áp dụng <strong>tối đa</strong> 1 mã giảm giá.</span>
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
                            Sử dụng mã giảm phí vận chuyển (tối đa 10.000 &#8363;) cho đơn hàng từ 0Đ khi mua hàng trên PING Cosmetics.
                        </li>
                        <li>
                            Áp dụng tất cả các hình thức thanh toán.
                        </li>
                        <li>
                            Số lượt sử dụng có hạn, chương trình và mã có thể kết thúc khi hết lượt ưu đãi hoặc khi hết hạn ưu đãi, tuỳ điều kiện nào đến trước.
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="payment-total-info payment-block">
    <div id="errorAlertPaymenMethod" class="alert alert-danger alert-dismissible fade show" role="alert" disabled>
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
                <select name="payment" id="payment">
                    <option value="" selected>Chọn phương thức</option>
                    <option value="BANKING">Chuyển khoản</option>
                    <option value="COD">Tiền mặt</option>
                </select>
            </div>
            <div class="payment-note">
                <strong>Lưu ý:</strong><br>
                <ul>
                    <li>Thành tiền đã bao gồm VAT, phí đóng gói, phí vận chuyển và các chi phí khác vui lòng xem <a href="" class="cyan-link txt-bold">chính sách vận chuyển</a>.</li>
                    <li>Nếu có nhu cầu đổi trả hàng, vui lòng xem <a href="" class="cyan-link txt-bold">chính sách đổi trả hàng</a> hoặc liên hệ hotline để được hướng dẫn chi tiết.</li>
                </ul>
            </div>
        </div>
        <div class="payment-right">
            <div class="payment-summary">
                <div class="first-summary">
                    <span class="left">Tạm tính</span>
                    <span class="right" id="totalPrice" >{{$totalPrice}} &#8363;</span>
                </div><br>
                <div class="shipping-cost">
                    <span class="left">Phí vận chuyển</span>
                    <span class="right"> &#8363;</span>
                </div><br>
                <div class="discount-money">
                    <span class="left">Giảm giá</span>
                    <span class="right" id="giamgia">0 &#8363;</span>
                </div><br>
                <hr>
                <div class="final-total-money">
                    <span class="txt-orange txt-bold txt-18 left">Thành tiền</span>
                    <span class="txt-orange txt-bold txt-18 right"name="totalPrice" id="thanhtien">{{$totalPrice}}</span>
                </div><br>
                <button type="button" class="order txt-uppercase" id="btn-finish" name="btn-finish">Đặt hàng</button>
            </div>
        </div>
    </div>
</div>
<div class="return">
    <a href="" class="cyan-link txt-14">Quay lại</a>
    <hr style="color: var(--gray);">
</div>
@include('user.layouts.template_footer')

<script>
    var discountPrice = 0;
    var discountValidCode = '';
    var totalPrice = parseInt(document.getElementById('totalPrice').innerText);
    var payment = document.getElementById('payment').value;
    $(document).ready(function() {
        // Initially hide the discount block and error message
        $('#errorAlertPaymenMethod').hide();
        $('.discount-detail').hide();
        $('#errorAlert').hide();
        $('#btn-apply-voucher').click(function(){
            var voucher = $('#discount-voucher').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('validate discount code')}}',
                    type: 'POST',
                    data: {
                        discountCode: voucher
                    },
                    success: function(response) {
                        if(response.isValid){
                            var discount_valid = response.discount;
                            var discountType = discount_valid.discountType;
                            if(discountType == 'percent'){
                                discountPrice = totalPrice * discount_valid.discountAmount / 100;
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
                                <td>${response.price}</td>
                            </tr>
                        `);
                            // Update the discount price
                            $('#giamgia').html(`${discountPrice} &#8363;`);
                            // Update the thanhtien
                            $('#thanhtien').html(`${totalPrice - discountPrice} &#8363;`);
                            // Show the discount detail section
                            $('.discount-detail').show();
                            $('#errorAlert').hide();
                        }else{
                            $('#giamgia').html(`0 &#8363;`);
                            $('#thanhtien').html(`${totalPrice} &#8363;`);
                            $('.discount-detail').hide();
                            $('#errorAlert').show();
                        }
                    },
                    error: function(error) {
                        // Xử lý lỗi
                        console.error('Lỗi request:', error);
                    }
                });
        })
    });

    document.getElementById('btn-finish').addEventListener('click', function() {
        var payment = document.getElementById('payment').value;
        if(payment == ''){
            $('#errorAlertPaymenMethod').show();
            return;
        }
        var requestData = {
            totalPrice: (totalPrice),
            paymentMethod: payment,
            discountValidCode: discountValidCode,
        };
        storeOrder(requestData);
    });
    function storeOrder(requestData){
            // Gửi AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store.order") }}',
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
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    // Đoạn mã JavaScript để lấy các phần tử DOM
    var editDeliveryContent = document.querySelector('.edit-delivery-content');
    var deliveryContent = document.querySelector('.delivery-content');
    var editLink = document.querySelector('.cyan-link');
    var saveButton = document.createElement('button');
    var provinceName = document.getElementById("orderProvince").innerText;
    var provinceID = 0;

    // Ẩn phần tử chỉnh sửa khi trang được tải
    editDeliveryContent.style.display = 'none';

    // Bắt sự kiện khi bấm vào nút "Chỉnh sửa"
    editLink.addEventListener('click', function (event) {
        event.preventDefault();
        // Ẩn phần tử thông tin hiển thị
        deliveryContent.style.display = 'none';
        // Hiển thị phần tử chỉnh sửa
        editDeliveryContent.style.display = 'block';
        // Tạo và thêm nút "Lưu lại"
        saveButton.textContent = 'Lưu lại';
        saveButton.className = 'btn-save';
        saveButton.addEventListener('click', luuThayDoi);
        editDeliveryContent.appendChild(saveButton);
        provinceName = document.getElementById("orderProvince").innerText;
        
       // provinceID = 

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
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }

        citis.onchange = function () {
            districts.length = 1;
            wards.length = 1;

            if (this.value != "") {
                const result = data.filter(n => n.Id === this.value);

                for (const k of result[0].Districts) {
                    districts.options[districts.options.length] = new Option(k.Name, k.Id);
                }
            }
        };

        districts.onchange = function () {
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

    

    // Đoạn mã JavaScript để xử lý sự kiện khi bấm nút "Lưu lại"
    function luuThayDoi() {
        // Lấy giá trị từ các phần tử select
        var selectedCity = citis.options[citis.selectedIndex].text;
        var selectedDistrict = districts.options[districts.selectedIndex].text;
        var selectedWard = wards.options[wards.selectedIndex].text;

        // Lấy giá trị từ textarea
        var deliveryNote = document.getElementById("delivery-note").value;

        // Cập nhật giá trị trong các phần tử HTML tương ứng
        document.getElementById("orderProvince").innerText = selectedCity;
        document.getElementById("orderAddress").innerText =selectedCity + ', ' + selectedDistrict + ", " + selectedWard;

        // Ẩn phần tử chỉnh sửa
        editDeliveryContent.style.display = 'none';
        // Hiển thị lại phần tử thông tin
        deliveryContent.style.display = 'block';
    }
</script>

