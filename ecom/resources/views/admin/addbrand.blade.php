@extends('admin.layouts.template')
@section('page_title')
PING - Brand
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm thương hiệu</h4>
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm thương hiệu</h5>
        <small class="text-muted float-end">Nhập thông tin</small>
      </div>
      <div class="card-body">
        <form action="{{route('storebrand')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập tên brand</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Haseline" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="categoryDescription">Mô tả thương hiệu</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="brandDescription" name="brandDescription" rows="3"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái thương hiệu</label>
            <div class="switch m-r-10">
              <input type="checkbox" id="isActive" name="isActive" checked="">
              <label for="isActive"></label>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
