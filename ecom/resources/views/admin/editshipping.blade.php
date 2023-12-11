@extends('admin.layouts.template')
@section('page_title')
PING - Edit shipping
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa thông tin shipping</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Sửa chi phí ship</h5>
                <small class="text-muted float-end">Sửa thông tin</small>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('updateshipping') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="shippingID" name="shippingID" value="{{$shipping_info->shippingID}}" />
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tên tỉnh/thành phố</label>
                        <div class="col-sm-10">
                            @foreach ($provinces as $province)
                            @if ($province->provinceID == $shipping_info->provinceID)
                            <input type="text" class="form-control" id="provinceName" name="provinceName" value="{{ $province->provinceName }}" disabled/>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập giá</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="shippingExpense" name="shippingExpense" value="{{$shipping_info->shippingExpense}}" />
                        </div>
                    </div>







                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection