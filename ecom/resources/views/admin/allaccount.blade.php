@extends('admin.layouts.template')
@section('page_title')
    PING - Tài khoản user
@endsection
@section('content')
    <div class="page-header no-gutters">
        <div class="row align-items-md-center">
            <div class="col-md-6">
                <div class="media m-v-10">
                    <div class="avatar avatar-cyan avatar-icon avatar-square">
                        <i class="anticon anticon-star"></i>
                    </div>
                    <div class="media-body m-l-15">
                        <h6 class="mb-0">Tất cả tài khoản khách hàng</h6>
                        <span class="text-gray font-size-13"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-md-right m-v-10">
                    <div class="btn-group">
                        <button id="list-view-btn" type="button" class="btn btn-default btn-icon">
                            <i class="anticon anticon-ordered-list"></i>
                        </button>
                        <button id="card-view-btn" type="button" class="btn btn-default btn-icon active">
                            <i class="anticon anticon-appstore"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <!-- Card View -->
            <div class="row" id="card-view">
                @foreach ($customerss as $customer)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-t-20 text-center">
                                    <div class="avatar avatar-image" style="height: 100px; width: 100px;">
                                        <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c3BpZGVybWFufGVufDB8fDB8fHww"
                                            alt="">
                                    </div>
                                    <h4 class="m-t-30">{{ $customer->customerName }}</h4>
                                    <p>{{ $customer->customerEmail }}</p>
                                </div>
                                <div class="text-center m-t-15">
                                    <p>{{ $customer->customerPhone }}</p>
                                </div>
                                <div class="text-center m-t-30">
                                    <a href="{{ route('detailaccount', $customer->customerID) }}"
                                        class="btn btn-primary btn-tone">
                                        <i class="anticon anticon-mail"></i>
                                        <span class="m-l-5">Chi tiết</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row d-none" id="list-view">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customerss as $customer)
                                            <tr>
                                                <td>
                                                    <div class="media align-items-center">
                                                        <div class="avatar avatar-image">
                                                            <img src="https://images.unsplash.com/photo-1635805737707-575885ab0820?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c3BpZGVybWFufGVufDB8fDB8fHww"
                                                                alt="">
                                                        </div>
                                                        <div class="media-body m-l-15">
                                                            <h6 class="mb-0">{{ $customer->customerName }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $customer->customerEmail }}</td>
                                                <td>{{ $customer->customerPhone }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('detailaccount', $customer->customerID) }}"
                                                        class="btn btn-primary btn-tone">
                                                        <i class="anticon anticon-mail"></i>
                                                        <span class="m-l-5">Chi tiết</span>
                                                    </a>
                                                </td>
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
    @endsection
    @section('customJS')
        <!-- Core Vendors JS -->
        <script src="{{ asset('js/app.min.js') }}"></script>

        <!-- page js -->
        <script src="{{ asset('js/vendors.min.js') }}"></script>

        <!-- Core JS -->
        <script src="{{ asset('js/profile.js') }}"></script>
    @endsection
