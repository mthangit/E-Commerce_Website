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
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/colored-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('attribute/images/favicon.ico') }}" /> --}}

    <!-- CSS
    ============================================ -->

    <!-- Vendor CSS (Contain Bootstrap, Icon Fonts) -->
    <link rel="stylesheet" href="{{ asset('attribute/css/vendor/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('attribute/css/vendor/Pe-icon-7-stroke.css') }}" />

    <!-- Plugin CSS (Global Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('attribute/css/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('attribute/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('attribute/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('attribute/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('attribute/css/plugins/magnific-popup.min.css') }}" />

    <!-- Minify Version -->
    <!-- <link rel="stylesheet" href="attribute/css/vendor/vendor.min.css"> -->
    <!-- <link rel="stylesheet" href="attribute/css/plugins/plugins.min.css"> -->

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('attribute/css/style.css') }}">
    <!-- <link rel="stylesheet" href="attribute/css/style.min.css"> -->

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
    <!-- Main Header Area End Here -->

    <!-- Begin Main Content Area -->
    <div class="account-page-area section-space-y-axis-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="account-orders-tab" data-bs-toggle="tab" href="#account-orders"
                                role="tab" aria-controls="account-orders" aria-selected="false">Orders</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address" role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-details-tab" data-bs-toggle="tab"
                                href="#account-details" role="tab" aria-controls="account-details"
                                aria-selected="false">Account Details</a>
                        </li>
                        <br>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                        <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel"
                            aria-labelledby="account-dashboard-tab">
                            <div class="myaccount-dashboard">
                                <p>Cảm ơn đã tin tưởng chúng tôi</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-orders" role="tabpanel"
                            aria-labelledby="account-orders-tab">
                            <div class="myaccount-orders">
                                <h4 class="small-title">MY ORDERS</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Trạng thái</th>
                                                <th>Tình trạng thanh toán</th>
                                                <th>Tổng tiền</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @foreach ($orders as $order)
                                            <tbody>
                                                <tr>
                                                    <td><a
                                                            href="{{ route('detailuserorder', $order->orderID) }}">{{ $order->orderID }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $order->orderCreatedDate }}
                                                    </td>
                                                    <td>
                                                        @if ($order->orderStatus == 'completed')
                                                            <div class="text-center text-success">
                                                                <b> Đã hoàn thành </b>
                                                            </div>
                                                        @elseif($order->orderStatus == 'processing')
                                                            <div class="text-center text-info">
                                                                <b> Đang xử lý </b>
                                                            </div>
                                                        @elseif($order->orderStatus == 'pending')
                                                            <div class="text-center text-warning">
                                                                <b> Đang chờ xử lý </b>
                                                            </div>
                                                        @elseif($order->orderStatus == 'canceled')
                                                            <div class="text-center text-danger">
                                                                <b> Đã huỷ </b>
                                                            </div>
                                                        @else
                                                            <div>Unknown Status</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $paymentStatus = $order->paymentStatus;
                                                        if ($order->paymentStatus == 'paid') {
                                                            $paymentStatus = 'Đã thanh toán';
                                                        } elseif ($order->paymentStatus == 'unpaid') {
                                                            $paymentStatus = 'Thanh toán khi nhận hàng';
                                                        } else {
                                                            $paymentStatus = 'Trạng thái không xác định';
                                                        }
                                                        ?>
                                                        {{ $paymentStatus . ' - ' . $order->paymentMethod }}
                                                    </td>
                                                    <td>{{ formatCurrency($order->grandPrice) }}</td>
                                                    <td><a href="{{ route('detailuserorder', $order->orderID) }}"
                                                            class="btn btn-secondary btn-primary-hover"><span>View</span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">
                            <div class="myaccount-address">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                <div class="row">
                                    <div class="col">
                                        <h4 class="small-title">BILLING ADDRESS</h4>
                                        <address>
                                            1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                        </address>
                                    </div>
                                    <div class="col">
                                        <h4 class="small-title">SHIPPING ADDRESS</h4>
                                        <address>
                                            1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="tab-pane fade" id="account-details" role="tabpanel"
                            aria-labelledby="account-details-tab">
                            <div class="card1">
                                <div class="card-header">
                                    <h4 class="card-title">Thông tin cá nhân</h4>
                                </div>
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-image  m-h-10 m-r-15"
                                            style="height: 80px; width: 80px">
                                            <img src="{{ asset('assets/user.png') }}" alt="">
                                        </div>
                                        <div class="m-l-20 m-r-20">
                                            <h5 class="m-b-5 font-size-18">{{ $customers->customerName }}</h5>
                                        </div>
                                    </div>
                                    <hr class="m-v-25">
                                    <form method="post"
                                        action="{{ route('updateaccount', ['customerID' => $customers->customerID]) }}">
                                        @csrf
                                        <div class="form-row">
                                            <input type="hidden" class="form-control" id="customerID"
                                                name="customerID" value="{{ $customers->customerID }}" />
                                            <input type="hidden" class="form-control" id="userID" name="userID"
                                                value="{{ $customers->userID }}" />
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="customerName">User
                                                    Name:</label>
                                                <input type="text" class="form-control" id="customerName"
                                                    name="customerName" value="{{ $customers->customerName }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="customerEmail">Email:</label>
                                                <input type="text" class="form-control" id="customerEmail"
                                                    name="customerEmail" value="{{ $customers->customerEmail }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="customerPhone">Phone
                                                    Number:</label>
                                                <input type="text" class="form-control" id="customerPhone"
                                                    name="customerPhone" value="{{ $customers->customerPhone }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="customerBirthDay">Date of
                                                    Birth:</label>
                                                <input type="date" class="form-control" id="customerBirthDay"
                                                    name="customerBirthDay"
                                                    value="{{ $customers->customerBirthDay }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="customerBankAccount">Bank
                                                    Account:</label>
                                                <input type="text" class="form-control" id="customerBankAccount"
                                                    name="customerBankAccount"
                                                    value="{{ $customers->customerBankAccount }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="customerBankName">Bank
                                                    Name:</label>
                                                <input type="text" class="form-control" id="customerBankName"
                                                    name="customerBankName"
                                                    value="{{ $customers->customerBankName }}">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card1">
                                <div class="card-header">
                                    <h4 class="card-title">Địa chỉ</h4>

                                    <a href="" class="cyan-link" style="color: rgb(128,128,128);">Chỉnh
                                        sửa</a>
                                </div>
                                <div class="card-body">
                                    <div class="edit-delivery-content">
                                        <div class="address-edit"
                                            style="display: flex; justify-content: space-between; width: 100%">
                                            <br>
                                            <select class="form-select form-select-sm mb-3 form-control"
                                                id="city" aria-label=".form-select-sm">
                                                <option value="" selected>Chọn tỉnh thành</option>
                                            </select>

                                            <select class="form-select form-select-sm mb-3 form-control"
                                                id="district" aria-label=".form-select-sm">
                                                <option value="" selected>Chọn quận huyện</option>
                                            </select>
                                            <select class="form-select form-select-sm mb-3 form-control"
                                                id="ward" aria-label=".form-select-sm">
                                                <option value="" selected>Chọn phường xã</option>
                                            </select>
                                            <br>
                                        </div>
                                        <div class="address-edit"
                                            style="display: flex; justify-content: space-between; width: 100%">
                                            <input type="text" name="address" id="address" class="form-control"
                                                placeholder="Nhập số nhà, tên đường"
                                                style="width: 100%; margin-bottom: 10px; margin-right: 10px">
                                        </div>
                                        <div class="address-edit"
                                            style="display: flex; justify-content: space-between; width: 100%">
                                            <button class="btn-save btn-primary" id="save-button"> Lưu lại</button>
                                        </div>
                                    </div>
                                    <div class="delivery-content">
                                        <div class="form-group col-md-12">
                                            <label class="font-weight-semibold" for="customerAddress">Địa chỉ chi
                                                tiết:</label>
                                            <input type="text" class="form-control" id="customerAddress"
                                                name="customerAddress" value="{{ $customers->customerAddress }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Area End Here -->

        <!-- Begin Scroll To Top -->
        <a class="scroll-to-top" href="">
            <i class="fa fa-chevron-up"></i>
        </a>
        <!-- Scroll To Top End Here -->

        <footer>
            <div class="footer-wrapper grid-3-col">
                <div class="basic-info">
                    <div class="logo">
                        <a href=""><img src="{{ asset('assets/logo.svg') }}" alt=""></a>
                    </div>
                    <div class="slogan">"All Ages, All Races, All Genders"</div>
                    <div class="address">Based in Ho Chi Minh City</div>
                    <div class="hotline"><span>Hotline:</span> <a href="tel:+0123456789">0123-456-789</a></div>
                </div>
                <div class="about-us">
                    <div class="about-us-title">
                        <h4>VỀ CHÚNG TÔI</h4>
                    </div>
                    <div class="introduction"><a href="{{ route('about') }}" class="heavy-link">Giới thiệu</a></div>
                    <div class="privacy-policy"><a href="{{ route('privacypolicy') }}" class="heavy-link">Chính sách
                            bảo mật</a></div>
                    <div class="terms-of-use"><a href="{{ route('termofuse') }}" class="heavy-link">Điều khoản sử
                            dụng</a></div>
                </div>
                <div class="page-support">
                    <div class="page-support-title">
                        <h4>HỖ TRỢ</h4>
                    </div>
                    <div class="most-asked-questions"><a href="{{ route('mostasked') }}" class="heavy-link">Các câu
                            hỏi thường gặp</a></div>
                    <div class="contact-info"><a href="{{ route('contact') }}" class="heavy-link">Thông tin liên
                            hệ</a></div>
                    <div class="delivery-policy"><a href="{{ route('deliverypolicy') }}" class="heavy-link">Chính
                            sách vận chuyển</a></div>
                    <div class="return-policy"><a href="{{ route('returnpolicy') }}" class="heavy-link">Chính sách
                            đổi trả</a></div>
                    <div class="send-support"><a href="/chatify/1" class="heavy-link">Gửi yêu cầu hỗ trợ</a></div>
                </div>
            </div>
            <div class="copyright">
                <div>Chịu trách nhiệm quản lý nội dung: PING Cosmetics - Số điện thoại: 0123-456-789</div>
                <div>&copy; 2023 - Bản quyền thuộc về PING Cosmetics</div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://kit.fontawesome.com/6594d9651c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>

        <!-- Global Vendor, plugins JS -->

        <!-- JS Files
    ============================================ -->
        <!-- Global Vendor, plugins JS -->

        <!-- Vendor JS -->
        <script src="{{ asset('attribute/js/vendor/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('attribute/js/vendor/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('attribute/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
        <script src="{{ asset('attribute/js/vendor/modernizr-3.11.2.min.js') }}"></script>
        <script src="{{ asset('attribute/js/vendor/jquery.waypoints.js') }}"></script>

        <!--Plugins JS-->
        <script src="{{ asset('attribute/js/plugins/wow.min.js') }}"></script>
        <script src="{{ asset('attribute/js/plugins/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('attribute/js/plugins/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('attribute/js/plugins/jquery.nice-select.js') }}"></script>
        <script src="{{ asset('attribute/js/plugins/parallax.min.js') }}"></script>
        <script src="{{ asset('attribute/js/plugins/jquery.magnific-popup.min.js') }}"></script>

        <!-- Minify Version -->
        <!-- <script src="attribute/js/vendor.min.js"></script> -->
        <!-- <script src="attribute/js/plugins.min.js"></script> -->

        <!--Main JS (Common Activation Codes)-->
        <script src="{{ asset('attribute/js/main.js') }}"></script>
        <!-- <script src="attribute/js/main.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script>
            // Đoạn mã JavaScript để lấy các phần tử DOM
            var editDeliveryContent = document.querySelector('.edit-delivery-content');
            var deliveryContent = document.querySelector('.delivery-content');
            var editLink = document.querySelector('.cyan-link');
            var saveButton = document.querySelector('.btn-save');

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

            // Đoạn mã JavaScript để xử lý sự kiện khi bấm nút "Lưu lại"
            function luuThayDoi() {
                // Lấy giá trị từ các phần tử select
                var selectedCity = citis.options[citis.selectedIndex].text;
                var selectedDistrict = districts.options[districts.selectedIndex].text;
                var selectedWard = wards.options[wards.selectedIndex].text;
                // Lấy giá trị từ textarea
                var deliveryAddress = document.getElementById("address").value;


                if (deliveryAddress === '' || selectedCity === 'Chọn tỉnh thành' || selectedDistrict === 'Chọn quận huyện' ||
                    selectedWard === 'Chọn phường xã') {
                    editDeliveryContent.style.display = 'none';
                    // Hiển thị lại phần tử thông tin
                    deliveryContent.style.display = 'block';
                    saveButton.style.display = 'none';
                } else {
                    // Cập nhật giá trị trong các phần tử HTML tương ứng
                    document.getElementById("customerAddress").value = deliveryAddress + ', ' + selectedWard + ", " +
                        selectedDistrict + ", " + selectedCity;
                    // Ẩn phần tử chỉnh sửa
                    editDeliveryContent.style.display = 'none';
                    // Hiển thị lại phần tử thông tin
                    deliveryContent.style.display = 'block';
                    saveButton.style.display = 'none';
                }


                // Gửi AJAX request để lưu vào CSDL
                axios.post('/update-address', {
                        customerID: document.getElementById("customerID").value,
                        newAddress: document.getElementById("customerAddress").value,
                        userID: document.getElementById("userID").value
                    })
                    .then(function(response) {
                        console.log(response.data.message);
                        // Xử lý thành công nếu cần
                    })
                    .catch(function(error) {
                        console.error('Error updating address:', error);
                        // Xử lý lỗi nếu cần
                    });
            }
        </script>
</body>

</html>
