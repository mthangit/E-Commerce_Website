@extends('admin.layouts.template')
@section('page_title')
PING - Add Category
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm danh mục sản phẩm</h4>
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm danh mục</h5>
        <small class="text-muted float-end">NHập thông tin</small>
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
        <form action="{{ route('storecategory') }}" method="POST" id="categoryForm" name="categoryForm">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Sữa tắm" />
              <p class="invalid-feedback"></p>         
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="categoryImage">Ảnh danh mục</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="categoryImage" name="categoryImage" accept="image/*" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="categoryDescription">Mô tả danh mục</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày tạo danh mục</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="categoryCreatedDate" name="categoryCreatedDate"/>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày dự kiến ngừng bán</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="categoryModifiedDate" name="categoryModifiedDate"  />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái sản phẩm</label>
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

@section('customJS')
<script>
$("categoryForm").submit(function(event){
  event.preventDefault();
  var element = $(this);

  $.ajax({
    url: '{{ route("storecategory") }}',
    type: 'POST',
    data: element.serializeArray(),
    dataType: 'json',


    success: function(response){
  

    },error: function(jqXHR, exception){
      console.log("Some thing went wrong, please try again later");
    }
  })

});
</script>
@endsection