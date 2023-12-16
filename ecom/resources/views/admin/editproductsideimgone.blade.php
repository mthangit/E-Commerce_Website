@extends('admin.layouts.template')
@section('page_title')
PING - Edit Image Product 1
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm sản phẩm</h4>
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm sản phẩm</h5>
        <small class="text-muted float-end">Nhập thông tin</small>
      </div>
      <div class="card-body">
        <form action="{{route('updateproductsideimgone')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">ảnh cũ</label>
            <div class="col-sm-10">
              <img src="{{asset($product_info->productSideImage1)}}" alt=""/>
            </div>
          </div>

          <input type="hidden" value="{{$product_info->productID}}" name="productID">

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình</label>
            <div class="col-sm-10">
              <input class="form-control" type="file"  name="productSideImageOne" id="productSideImageOne"   />
            </div>
          </div>
          


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Cập nhật hình ảnh</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection