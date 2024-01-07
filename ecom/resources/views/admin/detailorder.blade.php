@extends('admin.layouts.template')
@section('page_title')
    PING - Dashboard
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>OrderID : {{ $order->orderID }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('allorder') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <h1 class="h5 mb-3">Shipping Address</h1>
                                    <address>
                                        <strong>{{ $customerinfo->customerName }}</strong><br>
                                        {{ $customerinfo->customerAddress }}<br>
                                        {{ $customerinfo->customerPhone }}<br>
                                        {{ $customerinfo->customerEmail }}
                                    </address>
                                </div>
                                <div class="col-sm-6 invoice-col">
                                    <b>Ngày đặt hàng: {{ $order->orderCreatedDate }}</b><br>
                                    <br>
                                    <b>ID đơn hàng: </b>{{ $order->orderID }}<br>
                                    <b>Tổng tiền: {{ formatCurrency($order->grandPrice) }} VND</b><br>

                                    <?php
                                    if ($order->orderStatus == 'pending') {
                                        $status = 'warning';
                                    } elseif ($order->orderStatus == 'processing') {
                                        $status = 'primary';
                                    } elseif ($order->orderStatus == 'completed') {
                                        $status = 'success';
                                    } else {
                                        $status = 'danger';
                                    }
                                    ?>

                                    <b>Trạng thái đơn: </b> <span
                                        class="text-{{ $status }}">{{ $order->orderStatus }} -- lúc :
                                        {{ $order->orderCompletedDate }}</span>
                                    <br>


                                    <b>Phương thức thanh toán: </b>{{ $order->paymentMethod }}<br>
                                    @if ($order->paymentStatus == 'unpaid')
                                        <b>Trạng thái thanh toán: </b><span class="text-danger">Chưa thanh toán</span><br>
                                    @else
                                        <b>Trạng thái thanh toán: </b><span class="text-success">Đã thanh toán</span><br>
                                    @endif
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
                                    @foreach ($orderdetails as $orderdetail)
                                        <tr>
                                            <td>{{ $orderdetail->productName }}</td>
                                            <td>{{ $orderdetail->productPrice }}</td>
                                            <td>{{ $orderdetail->productQuantity }}</td>
                                            <td>{{ $orderdetail->productTotalPrice }}</td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <th colspan="3" class="text-right">Tổng tiền:</th>
                                        <td>{{ $order->totalPrice }} VND</td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Chi phí ship:</th>
                                        <td>{{ $order->shippingFee }} VND</td>
                                    </tr>
                                    @if ($discount == null)
                                        <tr>
                                            <th colspan="3" class="text-right">Mã giảm giá:</th>
                                            <td>Không có</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th colspan="3" class="text-right">Mã giảm giá
                                                ({{ $discount->discountCode }}):</th>
                                            <td>
                                                @if ($discount->discountType == 'percent')
                                                    {{ $discount->discountAmount }}%
                                                @else
                                                    {{ $discount->discountAmount }}VND
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="{{ route('updateorderstatus') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="orderID" name="orderID"
                                value="{{ $order->orderID }}" />
                            <div class="card-body">
                                <h2 class="h4 mb-3">Order Status</h2>
                                <div class="mb-3">
                                    <select name="orderStatus" id="orderStatus" class="form-control">
                                        <option value="pending" {{ $order->orderStatus == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="processing"
                                            {{ $order->orderStatus == 'processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="completed"
                                            {{ $order->orderStatus == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="canceled" {{ $order->orderStatus == 'canceled' ? 'selected' : '' }}>
                                            Cancel</option>
                                    </select>
                                </div>
                                <div class="mb-3">Vào lúc
                                    <input type="datetime-local" class="form-control" id="orderCompletedDate"
                                        name="orderCompletedDate" value="{{ $order->orderCompletedDate }}" />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Send Inovice Email</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Customer</option>
                                    <option value="">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
@endsection
