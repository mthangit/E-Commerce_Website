@include('user.layouts.template_header_logged')

<div class="main-container">
    <div class="row">
        <div class="col" style="margin-left: 80px;">
            <img src="https://unblast.com/wp-content/uploads/2020/04/Online-Shopping-Illustration.jpg" alt=""
                width="600">
        </div>
        <div class="col text-center" style="margin-top: auto; margin-bottom: auto;">
            <p class="txt-cyan h1 txt-uppercase" style="font-weight: 800; font-family: Arial;">Mua hàng thành công!</p>
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
            
            // $isError = request()->get('error');
            
            ?>

            <p class="txt-18">Phương thức thanh toán: <strong class="txt-cyan h5">
                    {{ $paymentMethod }}</strong></p>
            <div class="button-order-success">
                <button class="btn btn-outline-primary"><a href="{{ route('userdashboard') }}">
                        Trang chủ
                    </a></button> |
                <button class="btn btn-danger"><a href="{{ route('detailuserorder', $order->orderID) }}"> Xem chi tiết
                        đơn hàng </a></button>
            </div>

        </div>
    </div>
    <div class="text-center">
        @if (request('isError'))
            <p class="h6 font-weight-bold text-danger">Đơn hàng của bạn gặp lỗi trong quá trình thanh toán, tuy nhiên
                chúng tôi đã chuyển
                phương thức thanh toán thành COD</p>
            <p class="h5 font-italic">Tiền sẽ được hoàn về tài khoản của bạn trong vòng 10 - 14 ngày làm việc nếu bạn đã
                thanh toán</p>
            <p class="h5 font-italic">Chúng tôi thành thật xin lỗi vì sự bất tiện này</p>
        @endif
    </div>

</div>
@include('user.layouts.template_footer')
