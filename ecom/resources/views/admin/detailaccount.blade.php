@extends('admin.layouts.template')
@section('page_title')
PING - Tài khoản user
@endsection
@section('content')
<!-- Page Container START -->
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Setting</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-account">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-network">Lịch sử đơn hàng</a>
        </li>
    </ul>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Infomation</h4>
                </div>
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                            <img src="https://www.cnet.com/a/img/resize/fa38a5b9ea31b11e369c328cc63de0968985b4fd/hub/2023/02/16/e90ef303-aaf9-42cd-8943-88b5b6998563/social-crop-tom-holland-spidey.jpg?auto=webp&fit=crop&height=900&width=1200" alt="">
                        </div>
                        <div class="m-l-20 m-r-20">
                            <h5 class="m-b-5 font-size-18">{{$customers->customerName}}</h5>
                        </div>
                    </div>
                    <hr class="m-v-25">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-semibold" for="userName">User Name:</label>
                                <input type="text" class="form-control" id="userName" placeholder="User Name" value="{{$customers->customerName}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-semibold" for="email">Email:</label>
                                <input type="text" class="form-control" id="email" placeholder="email" value="{{$customers->customerEmail}}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="phoneNumber">Phone Number:</label>
                                <input type="text" class="form-control" id="phoneNumber" value="{{$customers->customerPhone}}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="dob">Date of Birth:</label>
                                <input type="text" class="form-control" id="dob" value="{{$customers->customerBirthDay}}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Change Password</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="oldPassword">Old Password:</label>
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Old Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="newPassword">New Password:</label>
                                        <input type="password" class="form-control" id="newPassword" placeholder="New Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary m-t-30">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Address Details</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-semibold" for="fullAddress">Full Address:</label>
                                <input type="text" class="form-control" id="fullAddress" value="{{$customers->customerAddress}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-semibold" for="stateCity">Bank Account:</label>
                                <input type="text" class="form-control" id="stateCity" value="{{$customers->customerBankAccount}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-semibold" for="stateCity">Bank Name:</label>
                                <input type="text" class="form-control" id="stateCity" value="{{$customers->customerBankName}}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-network">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lịch sử đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày cập nhật trạng thái</th>
                                        <th>Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($orders as $order )
                                    <tr>
                                        <td><a href="{{route('detailorder', $order->orderID)}}">{{$order->orderID}}</a></td>
                                        <td><a href="{{route('detailorder', $order->orderID)}}">
                                                {{$customers->customerName}}

                                            </a>
                                        </td>
                                        <td><a href="{{route('detailorder', $order->orderID)}}">
                                                {{$customers->customerEmail}}
                                            </a>
                                        </td>
                                        <td><a href="{{route('detailorder', $order->orderID)}}">
                                                {{$customers->customerPhone}}
                                            </a>
                                        </td>
                                        <td>
                                            @if($order->orderStatus == 'completed')
                                            <div class="d-flex align-items-center">
                                                <div class="badge badge-success badge-dot m-r-10"></div>
                                                <div>Completed</div>
                                            </div>
                                            @elseif($order->orderStatus == 'processing')
                                            <div class="d-flex align-items-center">
                                                <div class="badge badge-warning badge-dot m-r-10"></div>
                                                <div>Processing</div>
                                            </div>
                                            @elseif($order->orderStatus == 'pending')
                                            <div class="d-flex align-items-center">
                                                <div class="badge badge-info badge-dot m-r-10"></div>
                                                <div>Pending</div>
                                            </div>
                                            @elseif($order->orderStatus == 'cancel')
                                            <div class="d-flex align-items-center">
                                                <div class="badge badge-danger badge-dot m-r-10"></div>
                                                <div>Canceled</div>
                                            </div>
                                            @else
                                            <div>Unknown Status</div>
                                            @endif
                                        </td>
                                        <td>{{$order->orderCompletedDate}}</td>
                                        <td>{{$order->grandPrice}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->


    @endsection
    @section('customJS')
    <!-- Core Vendors JS -->
    <script src="{{ asset('js/app.min.js') }}"></script>

    <!-- page js -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>

    <!-- Core JS -->
    <script src="{{ asset('js/profile.js') }}"></script>
    @endsection
