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
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Kết quả</h5>
            </div>
            <div class="card-body">
                <table class="table" id="resultTable">
                    <thead>

                    </thead>
                    <tbody id="resultBody">
                        <!-- Results will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('btnKiemTra').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Dynamically set the form action to the fetchResults route
        document.getElementById('checkProductForm').action = "{{ route('fetchResults') }}";

        var form = document.getElementById('checkProductForm');
        var formData = new FormData(form);

        // Add AJAX request to fetch data from the backend
        $.ajax({
            type: 'POST',
            url: form.action,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Update the result table with the fetched data
                updateResultTable(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    function updateResultTable(data) {
    var resultBody = document.getElementById('resultBody');

    // Clear existing rows
    resultBody.innerHTML = '';

    // Create a new table element
    var resultTable = document.createElement('table');
    resultTable.className = 'table';
    resultTable.id = 'resultTable';

    var thead = document.createElement('thead');
    thead.innerHTML = '<tr><th scope="col">Tên sản phẩm</th><th scope="col">Ngày tạo</th><th scope="col">Số lượng</th><th scope="col">Giá sản phẩm</th></tr>';
    resultTable.appendChild(thead);

    var tbody = document.createElement('tbody');
    resultTable.appendChild(tbody);

    // Populate the new table with data
    data.forEach(function(item) {
        var row = tbody.insertRow(-1);
        row.innerHTML = '<td>' + item.productName + '</td>' +
            '<td>' + formatDate(item.created_at) + '</td>' +
            '<td>' + item.productQuantity + '</td>' +
            '<td>' + item.productTotalPrice + '</td>';
    });

    // Calculate the total sum of productQuantity and productTotalPrice
    var totalQuantity = data.reduce(function(acc, item) {
        return acc + item.productQuantity;
    }, 0);

    var totalPrice = data.reduce(function(acc, item) {
        return acc + item.productTotalPrice;
    }, 0);

    // Append a new row for the total sum
    var totalRow = tbody.insertRow(-1);
    totalRow.innerHTML = '<td><strong>Total</strong></td>' +
        '<td></td>' +
        '<td><strong>' + totalQuantity + '</strong></td>' +
        '<td><strong>' + totalPrice + '</strong></td>';

    // Append the new table to the result body
    resultBody.appendChild(resultTable);
}
    function formatDate(dateString) {
        var options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZoneName: 'short'
        };
        var formattedDate = new Date(dateString).toLocaleString('en-US', options);
        return formattedDate;
    }
</script>


@endsection