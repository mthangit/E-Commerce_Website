@extends('admin.layouts.template')
@section('page_title')
PING - Add Discount
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm tỉnh thành cần ship</h4>
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm chi phí ship</h5>
        <small class="text-muted float-end">Nhập thông tin</small>
      </div>
      <div class="card-body">
        <form action="{{route('storeshipping')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Chọn tỉnh thành</label>
            <div class="col-sm-10">
              <select class="form-control" id="provinceID" name="provinceID" aria-label="Default select example">
                <option>Lựa chọn danh mục cha</option>
                @foreach ($provinces as $province )
                <option value="{{$province->provinceID}}">{{$province->provinceName}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập giá</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="shippingExpense" name="shippingExpense" placeholder="50000VND" />
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Thêm mới chi phí</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection