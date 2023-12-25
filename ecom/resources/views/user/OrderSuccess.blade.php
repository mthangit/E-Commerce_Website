@include('user.layouts.template_header_logged')

<div class="main-container">
    <div class="row">
        <div class="col" style="margin-left: 80px;">
            <img src="https://unblast.com/wp-content/uploads/2020/04/Online-Shopping-Illustration.jpg" alt=""
                width="600">
        </div>
        <div class="col text-center" style="margin-top: auto; margin-bottom: auto;">
            <p class="txt-cyan h1 txt-uppercase" style="font-weight: 800;">Đặt hàng thành công!</p>
            <hr style="width: 50%; margin: 20px auto;">
            <p class="txt-18">Mã đơn hàng của bạn là: <strong class="txt-cyan h5"> {{ $order->orderID }}</strong></p>
            <p class="txt-18">Tổng tiền: <strong class="txt-cyan h5"> {{ formatCurrency($order->grandPrice) }}
                    VNĐ</strong></p>

            <?php
            $paymentMethod = $order->paymentMethod;
            if ($paymentMethod == 'COD') {
                $paymentMethod = 'Thanh toán khi nhận hàng';
            } else {
                $paymentMethod = $order->paymentMethod;
            }


            ?>

            @isset($isError)
                <p class="txt-18">Đơn hàng của bạn gặp lỗi trong quá trình thanh toán: <strong class="txt-cyan h5"> {{ $isError }}</strong></p>
            @endisset

            <p class="txt-18">Phương thức thanh toán: <strong class="txt-cyan h5"> {{ $paymentMethod }}</strong></p>
            <br>
            <div class="button-order-success">

                <button class="btn btn-outline-primary"><a href="{{ route('userdashboard') }}">
                        Trang chủ
                    </a></button> |
                <button class="btn btn-danger"><a href=""> Xem chi tiết đơn hàng </a></button>
            </div>
        </div>
    </div>
</div>
@include('user.layouts.template_footer')
