@extends('admin.layouts.template')
@section('page_title')
PING - Product
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
        <form action="{{route('storeproduct')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập tên sản phẩm</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productName" name="productName" placeholder="Kem chống nắng" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên thương hiệu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productBrandName" name="productBrandName" placeholder="Haseline" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Lựa chọn danh mục cha</label>
            <div class="col-sm-10">
              <select class="form-control" id="productCategoryID" name="productCategoryID" aria-label="Default select example">
                <option value="">Lựa chọn danh mục cha</option>
                @foreach ($categories as $category )
                <option value="{{$category->categoryID}}">{{$category->categoryName}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Lựa chọn danh mục con</label>
            <div class="col-sm-10">
              <select class="form-control" id="productSubCategoryID" name="productSubCategoryID" aria-label="Default select example">
                <option value="">Lựa chọn danh mục con</option>
                @foreach ($subcategories as $subcategory )
                <option class="subcategory" data-category="{{$subcategory->categoryID}}" value="{{$subcategory->subCategoryID}}">{{$subcategory->subCategoryName}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <script>
            document.getElementById('productCategoryID').addEventListener('change', function() {
              var selectedCategoryID = this.value;

              // Ẩn tất cả các option trong select subcategory
              var subcategories = document.querySelectorAll('.subcategory');
              subcategories.forEach(function(subcategory) {
                subcategory.style.display = 'none';
              });

              // Hiển thị chỉ những option thuộc category đã chọn
              var filteredSubcategories = document.querySelectorAll('.subcategory[data-category="' + selectedCategoryID + '"]');
              filteredSubcategories.forEach(function(subcategory) {
                subcategory.style.display = '';
              });
            });
          </script>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập giá gốc sản phẩm</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productOriginalPrice" name="productOriginalPrice" placeholder="50000" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập giá khuyến mãi sản phẩm</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productDiscountPrice" name="productDiscountPrice" placeholder="50000" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập mô tả sản phẩm</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productInfo" name="productInfo" placeholder="Sản phẩm không có thông tin" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Mã Barcode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productBarcode" name="productBarcode" placeholder="64651879845" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="productInStock" name="productInStock" placeholder="50" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình</label>
            <div class="col-sm-10">
              <input class="form-control" type="file"  name="productImage" id="productImage"   />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình 1</label>
            <div class="col-sm-10">
              <input class="form-control" type="file" id="productSideImage1" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình 2</label>
            <div class="col-sm-10">
              <input class="form-control" type="file" id="productSideImage2" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình 3</label>
            <div class="col-sm-10">
              <input class="form-control" type="file" id="productSideImage3" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày bắt đầu</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="2023-01-11" id="productCreatedDate" name="productCreatedDate"/>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày hết hạn</label>
            <div class="col-sm-10">
              <input class="form-control" type="date" value="2023-12-30" id="productModifiedDate" name="productModifiedDate" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái SALE</label>
            <div class="switch m-r-10">
              <input type="checkbox" id="isFlashSale" name="isFlashSale" checked="">
              <label for="isFlashSale"></label>
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
              <button type="submit" class="btn btn-primary">Thêm mới sản phẩm</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection