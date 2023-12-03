@extends('admin.layouts.template')
@section('page_title')
PING - Sub Category
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm danh mục sản phẩm con</h4>
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm danh mục con</h5>
        <small class="text-muted float-end">Nhập thông tin</small>
      </div>
      <div class="card-body">
        <form action="{{route('storesubcategory')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục con</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="subCategoryName" name="subCategoryName" placeholder="Sữa tắm cho bé" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">lựa chọn danh mục cha</label>
            <div class="col-sm-10">
              <select class="form-control" id="categoryID" name="categoryID" aria-label="Default select example">
                <option>Lựa chọn danh mục cha</option>
                @foreach ($categories as $category )
                <option value="{{$category->categoryID}}">{{$category->categoryName}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="categoryImage">Ảnh danh mục</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="subCategoryImage" name="subCategoryImage" accept="image/*" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="categoryDescription">Mô tả danh mục</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="subCategoryDescription" name="subCategoryDescription" rows="3"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày tạo danh mục</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="subCategoryCreatedDate" name="subCategoryCreatedDate" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày dự kiến ngừng bán</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="subCategoryModifiedDate" name="subCategoryModifiedDate" />
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
              <button type="submit" class="btn btn-primary">Thêm mới danh mục con</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
