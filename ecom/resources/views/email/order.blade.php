<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Email</title>
</head>

<body>
    <h1>
        Cảm ơn đã mua hàng
    </h1>

    <h2>
        ID đơn hàng : {{ $mailData['order']-> orderID }}
    </h2>
    <h2>Sản phẩm</h2>
    <table cellpadding="3" cellspacing="3" border="0">
        <thead>
            <tr>
                <th>Product</th>
                <th width="100">Price</th>
                <th width="100">Qty</th>
                <th width="100">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['order']-> items as $orderdetail )
            <tr>
                <td>{{$orderdetail->productName}}</td>
                <td>{{$orderdetail->productPrice}}</td>
                <td>{{$orderdetail->productQuantity}}</td>
                <td>{{$orderdetail->productTotalPrice}}</td>
            </tr>
            @endforeach


            <tr>
                <th colspan="3" class="text-right">Tổng tiền:</th>
                <td>{{$mailData['order']->totalPrice}} VND</td>
            </tr>

            <tr>
                <th colspan="3" class="text-right">Chi phí ship:</th>
                <td>{{$mailData['order']->shippingFee}} VND</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Mã giảm giá ({{$mailData['discount']->discountCode}}):</th>
                <td> @if($mailData['discount']->discountCode == 'percent')
                    {{$mailData['discount']->discountAmount}}%
                    @else
                    {{$mailData['discount']->discountAmount}}VND
                    @endif
                </td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Thành tiền:</th>
                <td>{{$mailData['order']->grandPrice}} VND</td>
            </tr>
        </tbody>
    </table>
</body>

</html>