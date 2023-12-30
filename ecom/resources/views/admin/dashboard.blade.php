@extends('admin.layouts.template')
@section('page_title')
PING - Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($totalSales, 2) }} VNĐ</h2>
                        <p class="m-b-0 text-muted">Tổng tiền đã thu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-line-chart"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">
                            @if ($growthPercentage >= 0)
                            +{{$growthPercentage }}%
                            @else
                            -{{$growthPercentage }}%
                            @endif
                        </h2>
                        <p class="m-b-0 text-muted">So với tháng trước</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                        <i class="anticon anticon-profile"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{$totalOrders}}</h2>
                        <p class="m-b-0 text-muted">tổng đơn hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-purple">
                        <i class="anticon anticon-user"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{$totalCustomers}}</h2>
                        <p class="m-b-0 text-muted">tổng khách hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
