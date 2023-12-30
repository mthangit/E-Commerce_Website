@extends('admin.layouts.template')
@section('page_title')
PING - Product
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thống kê tổng tiền bán được</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Kiểm tra</h5>
                <small class="text-muted float-end">Nhập thông tin</small>
            </div>
            <div class="card-body">
                <form id="checkProductForm" method="POST" enctype="multipart/form-data">
                    @csrf

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

        <!-- Result Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Kết quả</h5>
            </div>
            <div class="card-body">
                <div id="resultSection">
                    <!-- Result will be inserted here -->
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('btnKiemTra').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Dynamically set the form action to the fetchResults route
        document.getElementById('checkProductForm').action = "{{ route('fetchSalesResults') }}";

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
                // Update the result section with the fetched data
                updateResultSection(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    function updateResultSection(data) {
        var resultSection = document.getElementById('resultSection');

        // Clear existing content
        resultSection.innerHTML = '';

        // Display the total sales amount
        var totalSales = document.createElement('div');
        totalSales.innerHTML = '<strong>Total Sales:</strong> ' + data.totalSales;
        resultSection.appendChild(totalSales);
    }
</script>

@endsection