<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .status {
            display: inline-block;
            padding: 8px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }

        .paid {
            background-color: #27ae60;
        }

        .pending {
            background-color: #f39c12;
        }

        .method {
            font-style: italic;
            color: #d35400;
            /* Màu cam phong cách tết */
        }

        .order-status {
            margin-top: 20px;
        }

        .order-status span {
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .order-status .paid {
            background-color: #27ae60;
            color: #fff;
        }

        .order-status .pending {
            background-color: #f39c12;
            color: #fff;
        }

        .thank-you {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        .txt-cyan {
            color: #0097B2;
        }
    </style>
</head>



<body>
    <div class="container">
        <h1 class="txt-cyan" style="font-weight: 600;">Chi tiết đơn hàng</h1>
        <p><strong>Tên người đặt hàng :</strong> {{ $mailData['order']->orderCustomerName }}</p>
        <p><strong>Địa chỉ:</strong> {{ $mailData['order']->orderAddress }} </p>
        <p><strong>Số điện thoại:</strong> {{ $mailData['order']->orderPhone }}</p>
        <p><strong>Mã đơn hàng:</strong> {{ $mailData['order']->orderID }}</p>
        <p><strong>Mã giảm giá:</strong> {{ $mailData['order']->discountCode }}</p>
        <p><strong>Giảm giá:</strong> {{ formatCurrency($mailData['order']->discountPrice) }} VNĐ</p>
        <p><strong>Phí vận chuyển:</strong> {{ formatCurrency($mailData['order']->shippingFee) }} VNĐ</p>
        <p><strong>Tổng tiền:</strong> {{ formatCurrency($mailData['order']->grandPrice) }} VNĐ</p>
        <p><strong>Phương thức thanh toán:</strong> <span class="method">{{ $mailData['order']->paymentMethod }}</span>
        </p>
        {{-- <p><strong>Tình trạng thanh toán:</strong> <span class="status paid">Đã thanh toán</span></p> --}}


        @if ($mailData['order']->paymentStatus == 'unpaid')
            <p><strong>Tình trạng thanh toán:</strong> <span class="status pending">Thanh toán khi nhận hàng</span></p>
        @else
            <p><strong>Tình trạng thanh toán:</strong> <span class="status paid">Đã thanh toán</span></p>
        @endif




        <h2>Bảng Chi Tiết Đơn Hàng</h2>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mailData['orderDetails'] as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->productName }}</td>
                        <td>{{ $orderDetail->productQuantity }}</td>
                        <td>{{ formatCurrency($orderDetail->productPrice) }}</td>
                        <td>{{ formatCurrency($orderDetail->productTotalPrice) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="thank-you"> Chúng tôi sẽ nhanh chóng đóng gói để đưa đơn hàng đến với bạn nhanh nhất</p>
        <p class="thank-you">Cảm ơn bạn đã mua hàng tại chúng tôi!</p>
    </div>
</body>

</html>
