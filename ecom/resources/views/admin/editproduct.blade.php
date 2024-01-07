@extends('admin.layouts.template')
@section('page_title')
PING - EDIT PRODUCT
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Cập nhật sản phẩm</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Thêm danh mục</h5>
                <small class="text-muted float-end">Nhập thông tin</small>
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
                <form action="{{ route('updateproduct') }}" method="POST" id="productForm" name="productForm">
                    @csrf
                    <input type="hidden" class="form-control" id="productID" name="productID" value="{{ $product_info->productID }}" />
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="productName" name="productName" value="{{ $product_info->productName }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tên thương hiệu</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="productBrandID" name="productBrandID" aria-label="Default select example">
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->brandID }}" {{ $product_info->productBrandID == $brand->brandID ? 'selected' : '' }}>
                                    {{ $brand->brandName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Lựa chọn danh mục cha</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="productCategoryID" name="productCategoryID" aria-label="Default select example">
                                @foreach ($categories as $category)
                                <option value="{{ $category->categoryID }}" {{ $product_info->productCategoryID == $category->categoryID ? 'selected' : '' }}>
                                    {{ $category->categoryName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Lựa chọn danh mục con</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="productSubCategoryID" name="productSubCategoryID" aria-label="Default select example">
                                <option value="" {{ empty($product_info->productSubCategoryID) ? 'selected' : '' }}></option>
                                @foreach ($subcategories as $subcategory)
                                <option class="subcategory" data-category="{{ $subcategory->categoryID }}" value="{{ $subcategory->subCategoryID }}" {{ $product_info->productSubCategoryID == $subcategory->subCategoryID ? 'selected' : '' }}>
                                    {{ $subcategory->subCategoryName }}
                                </option>
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
                            var filteredSubcategories = document.querySelectorAll('.subcategory[data-category="' +
                                selectedCategoryID + '"]');
                            filteredSubcategories.forEach(function(subcategory) {
                                subcategory.style.display = '';
                            });
                        });
                    </script>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập giá gốc sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="productOriginalPrice" name="productOriginalPrice" value="{{ $product_info->productOriginalPrice }}" oninput="validateInput(this)" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập giá khuyến mãi sản
                            phẩm</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="productDiscountPrice" name="productDiscountPrice" value="{{ $product_info->productDiscountPrice }}" oninput="validateInput(this)"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập mô tả sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="productInfo" name="productInfo" value="{{ $product_info->productInfo }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Mã Barcode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="productBarcode" name="productBarcode" value="{{ $product_info->productBarcode }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="productInStock" name="productInStock" value="{{ $product_info->productInStock }}" oninput="validateInput(this)"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng đã bán</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="" name="" value="{{ $product_info->productSoldQuantity }}" readonly />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình</label>
                        <div class="col-sm-10">
                            @if ($product_info->productImage)
                            <img style="height:100px" src="{{ asset($product_info->productImage) }}" alt="">
                            <button type="button" class="btn btn-primary" onclick="updateImage()">cập nhật
                                ảnh</button>
                            @endif
                            <input type="hidden" name="deleteImage" id="deleteImageInput" value="0">
                        </div>
                    </div>

                    <script>
                        function updateImage() {
                            window.location.href = "{{ route('editproductimg', $product_info->productID) }}";
                        }
                    </script>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình 1</label>
                        <div class="col-sm-10">
                            @if ($product_info->productImage)
                            <img style="height:100px" src="{{ asset($product_info->productSideImage1) }}" alt="">
                            <button type="button" class="btn btn-primary" onclick="updateImageOne()">cập nhật
                                ảnh</button>
                            @endif
                            <input type="hidden" name="deleteImageOne" id="deleteImageInputOne" value="0">
                        </div>
                    </div>

                    <script>
                        function updateImageOne() {
                            window.location.href = "{{ route('editproductsideimgone', $product_info->productID) }}";
                        }
                    </script>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình 2</label>
                        <div class="col-sm-10">
                            @if ($product_info->productSideImage1)
                            <img style="height:100px" src="{{ asset($product_info->productSideImage2) }}" alt="">
                            <button type="button" class="btn btn-primary" onclick="updateImageTwo()">cập nhật
                                ảnh</button>
                            @endif
                            <input type="hidden" name="deleteImageTwo" id="deleteImageInputTwo" value="0">
                        </div>
                    </div>

                    <script>
                        function updateImageTwo() {
                            window.location.href = "{{ route('editproductsideimgtwo', $product_info->productID) }}";
                        }
                    </script>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình 3</label>
                        <div class="col-sm-10">
                            @if ($product_info->productImage)
                            <img style="height:100px" src="{{ asset($product_info->productSideImage3) }}" alt="">
                            <button type="button" class="btn btn-primary" onclick="updateImageThree()">cập nhật
                                ảnh</button>
                            @endif
                            <input type="hidden" name="deleteImageThree" id="deleteImageInputThree" value="0">
                        </div>
                    </div>

                    <script>
                        function updateImageThree() {
                            window.location.href = "{{ route('editproductsideimgthree', $product_info->productID) }}";
                        }
                    </script>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="categoryCreatedDate">Ngày tạo</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="productCreatedDate" name="productCreatedDate" value="{{ $product_info->productCreatedDate }}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="categoryModifiedDate">Ngày cập nhật</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="productModifiedDate" name="productModifiedDate" value="{{ $product_info->productModifiedDate }}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái sản phẩm</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive" {{ $product_info->isActive ? 'checked' : '' }}>
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

@section('customJS')
<script>
        function validateInput(input) {
        const value = input.value;
        if (value < 1) {
            input.value = 1;
        }
    }

</script>
@endsection
