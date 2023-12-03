@extends('admin.layouts.template')
@section('page_title')
PING - Add Discount
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm mã giảm giá</h4>
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm mã giảm giá</h5>
        <small class="text-muted float-end">Nhập thông tin</small>
      </div>
      <div class="card-body">
        <form action="{{route('storediscount')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập tên mã giảm giá</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="discountName" name="discountName" placeholder="Mã giảm lễ tết" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập Code</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="discountCode" name="discountCode" placeholder="TET30" />
            </div>
          </div>


          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập mô tả mã giảm giá</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="discountDescription" name="discountDescription" placeholder="thông tin" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Loại mã giảm giá</label>
            <div class="col-sm-10">
              <select class="form-control" id="discountType" name="discountType">
                <option value="percent">Phần trăm</option>
                <option value="fixed">Trừ tiền</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">giá trị giảm</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="discountAmount" name="discountAmount" placeholder="% OR VND" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng ban đầu</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="discountQuantity" name="discountQuantity" placeholder="50" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày bắt đầu</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="2023-01-11" id="discountStart" name="discountStart" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày hết hạn</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="2023-12-30" id="discountEnd" name="discountEnd" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái mã giảm giá</label>
            <div class="switch m-r-10">
              <input type="checkbox" id="isActive" name="isActive" checked="">
              <label for="isActive"></label>
            </div>
          </div>


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Thêm mới mã giảm giá</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection