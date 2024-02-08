@extends('admin.layouts.template')
@section('page_title')
    PING - Edit Discount
@endsection
@section('content')
    <!-- Content -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa thông tin Discount</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Sửa mã giảm giá</h5>
                    <small class="text-muted float-end">Sửa thông tin</small>
                </div>

                <div id="errorDate_Edit" class="alert alert-warning alert-dismissible fade show small-alert" role="alert"
                    disabled>
                    <strong>Error!</strong> Ngày kết thúc phải lớn hơn ngày bắt đầu.
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                    {{-- <form action="{{ route('updatediscount') }}" method="POST">
                        @csrf --}}
                    <input type="hidden" class="form-control" id="discountID" name="discountID"
                        value="{{ $discount_info->discountID }}" />
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountName" name="discountName"
                                value="{{ $discount_info->discountName }} " />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Mã Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountCode" name="discountCode"
                                value="{{ $discount_info->discountCode }}" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Thông tin mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountDescription" name="discountDescription"
                                value="{{ $discount_info->discountDescription }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Loại mã giảm giá</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="discountType" name="discountType"
                                value="{{ $discount_info->discountType }}">
                                <option value="percent">Phần trăm</option>
                                <option value="fixed">Trừ tiền</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Gía trị mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="discountAmount" name="discountAmount"
                                oninput="validateInputNumber(this)" value="{{ $discount_info->discountAmount }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountDescription">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="discountQuantity" name="discountQuantity"
                                value="{{ $discount_info->discountQuantity }}" oninput="validedateNumberQuantity(this)"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountCreatedDate">Ngày hiệu lực</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="discountStart" name="discountStart"
                                value="{{ $discount_info->discountStart }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="discountModifiedDate">Ngày hết hạn</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="discountEnd" name="discountEnd"
                                value="{{ $discount_info->discountEnd }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái sản phẩm</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive"
                                {{ $discount_info->isActive ? 'checked' : '' }}>
                            <label for="isActive"></label>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-primary" id="btn-submit-edit">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $('document').ready(function() {
            $("#errorDate_Edit").hide();
        });

        function validedateNumberQuantity(input) {
            if (input.value < 1) {
                input.value = 1;
            }
        }


        $("#discountType").change(function() {
            $("#discountAmount").val("");
        });

        function validateInputNumber(input) {

            var type = $("#discountType").val();
            if (type == "percent") {
                if (input.value > 90) {
                    input.value = 90;
                } else if (input.value < 1) {
                    input.value = 1;
                }
            } else {
                if (input.value < 1) {
                    input.value = 1;
                }
            }
        }

        $("#btn-submit-edit").click(function(event) {
            var createdDate = document.getElementById("discountStart").value;
            var discountEndValue = document.getElementById("discountEnd").value;

            if (createdDate > discountEndValue) {
                $("#errorDate_Edit").show();
                return false;
            }
            var data = {
                discountID: $("#discountID").val(),
                discountName: $("#discountName").val(),
                discountCode: $("#discountCode").val(),
                discountDescription: $("#discountDescription").val(),
                discountType: $("#discountType").val(),
                discountAmount: $("#discountAmount").val(),
                discountQuantity: $("#discountQuantity").val(),
                discountStart: $("#discountStart").val(),
                discountEnd: $("#discountEnd").val(),
                isActive: $("#isActive").val(),
            };

            $.ajax({
                url: '{{ route('updatediscount') }}',
                type: 'POST',
                data: data,
                dataType: 'json',

                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('alldiscount') }}";
                    }
                },
                error: function(data) {
                    if (data.status == 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors.errors, function(key, value) {
                            $("#" + key + "_error").text(value[0]);
                        });
                    }
                }
            });

        });
    </script>
@endsection
