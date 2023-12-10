@include('user.layouts.template_header_logged')

<h1>
    Đặt hàng thành công
</h1>
<h2>
    Mã đơn hàng của bạn là: {{$order->orderID}}
</h2>
@include('user.layouts.template_footer')
