@include('user.layouts.template_header_logged')
<div class="page-navigation">
    <ul class="breadcrumb">
        <li><a href="{{ route('userdashboard') }}">Trang chủ</a></li>
        <li>Chi tiết đơn</li>
    </ul>
</div>
<?php
$orderStatus = $order->orderStatus;
if ($order->orderStatus == 'completed') {
    $orderStatus = 'Đã hoàn thành';
} elseif ($order->orderStatus == 'processing') {
    $orderStatus = 'Đang xử lý';
} elseif ($order->orderStatus == 'pending') {
    $orderStatus = 'Đang chờ xử lý';
} elseif ($order->orderStatus == 'cancel') {
    $orderStatus = 'Đã hủy';
} else {
    $orderStatus = 'Trạng thái không xác định';
}
?>

<style>
    .info-title {
        font-size: 18px;
        /* Kích thước font */
        font-weight: bold;
        /* Độ đậm của font */
        color: #FFA500;
        /* Màu cam */
        font-style: italic;
        /* Chữ in nghiêng */
    }

    h3 {
        font-weight: bold
    }
</style>

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="col-md-6">
            <a href="{{ route('detailuseraccount', Auth::user()->id) }}" class="btn btn-primary">Back</a>
        </div>
        <div class="row align-items-center justify-content-between mb-2 text-center">
            <div class="col-md-6 mx-auto">
                <h3>ĐƠN HÀNG: {{ $order->orderID }}</h3>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content">
    <!-- Default box -->
    <div class="container-fluid justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="card1 d-flex justify-content-center">
                    <div class="card-header pt-3">
                        <div>
                            <h5 class="info-title">Thông tin người đặt</h5>
                            <address>
                                Tên người đặt: <strong> {{ $customerinfo->customerName }}</strong><br>
                                Địa chỉ:
                                <b>
                                    {{ $customerinfo->customerAddress }}<br>
                                </b>
                                Số điện thoại: <b> {{ $customerinfo->customerPhone }}</b><br>
                                Email: <b> {{ $customerinfo->customerEmail }} </b>
                            </address>
                        </div>
                        <div>
                            <h5 class="info-title">Thông tin người đặt</h5>
                            Ngày đặt: <b>{{ $order->orderCreatedDate }}</b><br>
                            Tổng tiền: <b>{{ formatCurrency($order->grandPrice) }} VND</b><br>
                            Phương thức thanh toán: <b>{{ $order->paymentMethod }}<br>
                            </b>
                            @if ($order->paymentStatus == 'unpaid')
                                Trạng thái thanh toán: <b>Thanh toán khi nhận hàng</b>
                                <br>
                            @else
                                Trạng thái thanh toán: <b> <span class="text-success">Đã thanh toán</span></b>
                                <br>
                            @endif
                            Trạng thái đơn: <b> <span class="text-success">{{ $orderStatus }}
                                </span></b>
                            @if ($order->orderStatus != 'pending')
                                -- lúc {{ $order->orderCompletedDate }}
                            @endif
                        </div>
                        <br>
                        @if ($order->orderStatus == 'pending')
                            <div class="text-left">
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">
                                    Hủy đơn hàng
                            </div>
                            <br>
                        @elseif($order->orderStatus == 'completed')
                            <div class="text-left">
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#cancelOrderModal">
                                    Trả đơn hàng
                            </div>
                            <br>
                        @endif
                    </div>
                    <style>
                        .table {
                            text-align: left;
                        }

                        .table th,
                        .table td {
                            text-align: left;
                        }
                    </style>

                    {{-- <div class="card-body table-responsive p-3"> --}}
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th width="100">Giá bán</th>
                                <th width="100">Số lượng</th>
                                <th width="100">Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderdetails as $orderdetail)
                                <tr>
                                    <td>
                                        {{ $orderdetail->productName }}</td>
                                    <td>{{ formatCurrency($orderdetail->productPrice) }}</td>
                                    <td>{{ $orderdetail->productQuantity }}</td>
                                    <div text-right>
                                        <td>{{ formatCurrency($orderdetail->productTotalPrice) }}</td>
                                    </div>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3" class="text-right">Tổng tiền:</th>
                                <td>{{ formatCurrency($order->totalPrice) }} VND</td>
                            </tr>

                            <tr>
                                <th colspan="3" class="text-right">Chi phí ship:</th>
                                <td>{{ formatCurrency($order->shippingFee) }} VND</td>
                            </tr>
                            @if ($discount == null)
                                <tr>
                                    <th colspan="3" class="text-right">Mã giảm giá:</th>
                                    <td>Không có</td>
                                </tr>
                            @else
                                <tr>
                                    <th colspan="3" class="text-right">Mã giảm giá
                                        ({{ formatCurrency($discount->discountCode) }}):</th>
                                    <td>
                                        @if ($discount->discountType == 'percent')
                                            {{ $discount->discountAmount }}%
                                        @else
                                            {{ formatCurrency($discount->discountAmount) }}VND
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th colspan="3" class="text-right">Thành tiền:</th>
                                <td>{{ formatCurrency($order->grandPrice) }} VND</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@include('user.layouts.template_footer')
