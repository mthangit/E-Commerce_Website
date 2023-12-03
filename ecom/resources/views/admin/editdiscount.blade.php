@extends('admin.layouts.template')
@section('page_title')
PING - Edit Discount
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa thông tin discount</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Sửa danh mục</h5>
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
                <form action="{{ route('updatediscount') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="discountID" name="discountID" value="{{$discount_info->discountID}}" />
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountName" name="discountName" value="{{$discount_info->discountName}} " />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Mã Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountCode" name="discountCode" value="{{$discount_info->discountCode}}" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Thông tin mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountDescription" name="discountDescription" value="{{$discount_info->discountDescription}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Loại mã giảm giá</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="discountType" name="discountType" value="{{$discount_info->discountType}}">
                                <option value="percent">Phần trăm</option>
                                <option value="fixed">Trừ tiền</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Gía trị mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="discountAmount" name="discountAmount" value="{{$discount_info->discountAmount}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="discountQuantity" name="discountQuantity" value="{{$discount_info->discountQuantity}}" />
                        </div>
                    </div>



                  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountCreatedDate">discount Start</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="discountStart" name="discountStart" value="{{$discount_info->discountStart}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountModifiedDate">discount End</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="discountEnd" name="discountEnd" value="{{$discount_info->discountEnd}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái mã</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive" checked="">
                            <label for="isActive"></label>
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