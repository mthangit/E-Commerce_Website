@extends('admin.layouts.template')
@section('page_title')
PING - Product
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Kiểm tra sản phẩm</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Kiểm tra</h5>
                <small class="text-muted float-end">Nhập thông tin</small>
            </div>
            <div class="card-body">
                <form id="checkProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Lựa chọn danh mục cha</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="productCategoryID" name="productCategoryID" aria-label="Default select example">
                                <option value="" disabled selected>Lựa chọn danh mục cha</option>
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
                                <option value="" disabled selected>Lựa chọn danh mục con</option>
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
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Lựa chọn sản phẩm</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="productID" name="productID" aria-label="Default select example">
                                <option value="" disabled selected>Lựa chọn sản phẩm</option>
                                @foreach ($products as $product)
                                <option class="product" data-subcategory="{{ $product->productSubCategoryID }}" value="{{ $product->productID }}">{{ $product->productName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <script>
                        document.getElementById('productSubCategoryID').addEventListener('change', function() {
                            var selectedSubCategoryID = this.value;

                            // Ẩn tất cả các option trong select product
                            var products = document.querySelectorAll('.product');
                            products.forEach(function(product) {
                                product.style.display = 'none';
                            });

                            // Hiển thị chỉ những option thuộc subcategory đã chọn
                            var filteredProducts = document.querySelectorAll('.product[data-subcategory="' + selectedSubCategoryID + '"]');
                            filteredProducts.forEach(function(product) {
                                product.style.display = '';
                            });
                        });
                    </script>


                    <!-- Add start date and end date fields -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="start_date">Start Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <label class="col-sm-2 col-form-label" for="end_date">End Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>




                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" id="btnKiemTra" class="btn btn-primary">Kiểm tra</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Result Table -->
        <table id="productTable" class="display">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Thời gian</th>
                    <th>Đã bán</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                <tr>
                    <td>{{ $result->productName }}</td>
                    <td>{{ $result->created_at }}</td>
                    <td>{{ $result->productQuantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#productTable').DataTable();
    });
</script>


@endsection