@include('user.layouts.template_header_logged')
<div class="page-navigation">
    <ul class="breadcrumb">
        <li><a href="">Trang chủ</a></li>
        <li>Chi tiết đơn</li>
    </ul>
</div>

<section class="content-header" style="justify-content: center">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>OrderID : {{$order->orderID}}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('detailuseraccount', Auth::user()->id)}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content">
    <!-- Default box -->
    <div class="container-fluid justify-content-between align-items-center" >
        <div class="row">
            <div class="col-md-9">
                <div class="card1">
                    <div class="card-header pt-3">
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <h1 class="h5 mb-3">Shipping Address</h1>
                                <address>
                                    <strong>{{$customerinfo->customerName}}</strong><br>
                                    {{$customerinfo->customerAddress}}<br>
                                    {{$customerinfo->customerPhone}}<br>
                                    {{$customerinfo->customerEmail}}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>ID đơn hàng: </b>{{$order->orderID}}<br>
                                <b>Tổng tiền: </b>{{$order->grandPrice}} VND<br>
                                <b>Trạng thái đơn: </b> <span class="text-success">{{$order->orderStatus}} -- lúc : {{$order->orderCompletedDate}}</span>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th width="100">Price</th>
                                    <th width="100">Qty</th>
                                    <th width="100">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderdetails as $orderdetail )
                                <tr>
                                    <td>{{$orderdetail->productName}}</td>
                                    <td>{{$orderdetail->productPrice}}</td>
                                    <td>{{$orderdetail->productQuantity}}</td>
                                    <td>{{$orderdetail->productTotalPrice}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3" class="text-right">Tổng tiền:</th>
                                    <td>{{$order->totalPrice}} VND</td>
                                </tr>

                                <tr>
                                    <th colspan="3" class="text-right">Chi phí ship:</th>
                                    <td>{{$order->shippingFee}} VND</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Mã giảm giá ({{$order->discountCode }}):</th>
                                    <td> @if($discount->discountType == 'percent')
                                        {{$discount->discountAmount}}%
                                        @else
                                        {{$discount->discountAmount}}VND
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Thành tiền:</th>
                                    <td>{{$order->grandPrice}} VND</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@include('user.layouts.template_footer')
