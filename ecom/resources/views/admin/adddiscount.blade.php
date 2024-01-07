@extends('admin.layouts.template')
@section('page_title')
    PING - Add Discount
@endsection
@section('content')
    <!-- Content -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm mã giảm giá</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Thêm mã giảm giá</h5>
                    <small class="text-muted float-end">Nhập thông tin</small>
                </div>

                <div id="errorDate" class="alert alert-warning alert-dismissible fade show small-alert" role="alert"
                    disabled>
                    <strong>Error!</strong> Ngày kết thúc phải lớn hơn ngày bắt đầu.
                    <button type="button" class="btn-close btn-lg" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card-body">
                    {{-- <form action="{{ route('storediscount') }}" method="POST">
                        @csrf --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập tên mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountName" name="discountName"
                                placeholder="Mã giảm lễ tết" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountCode" name="discountCode"
                                placeholder="TET30" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập mô tả mã giảm giá</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="discountDescription" name="discountDescription"
                                placeholder="thông tin" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Loại mã giảm giá</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="discountType" name="discountType">
                                <option value="percent">Phần trăm</option>
                                <option value="fixed">Trừ tiền</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">giá trị giảm</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="discountAmount" name="discountAmount"
                                placeholder="% OR VND" oninput="validateInputNumber(this)" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng ban đầu</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="discountQuantity" name="discountQuantity"
                                placeholder="50" oninput="validedateNumberQuantity(this)" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày bắt đầu</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" value="2023-01-11" id="discountStart"
                                name="discountStart" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày hết hạn</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" value="2023-12-30" id="discountEnd"
                                name="discountEnd" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái mã giảm giá</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive" checked="">
                            <label for="isActive"></label>
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-primary" id="btn-submit">Thêm mới mã giảm giá</button>
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
        $("#errorDate").hide();

        $("#discountType").change(function() {
            $("#discountAmount").val("");
        });

        function validedateNumberQuantity(input) {
            if (input.value < 1) {
                input.value = 1;
            }
        }

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

        $("#btn-submit").click(function(event) {

            var createdDate = document.getElementById("discountStart").value;
            var discountEndValue = document.getElementById("discountEnd").value;

            if (createdDate > discountEndValue) {
                $("#errorDate").show();
                return false;
            }

            var data = {
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
                url: '{{ route('storediscount') }}',
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

        // $.ajax({
        //     url: '{{ route('storediscount') }}',
        //     type: 'POST',
        //     data: element.serializeArray(),
        //     dataType: 'json',

        //     success: function(data) {
        //         if (data.status == 200) {
        //             alert(data.message);
        //         }
        //     },
        //     error: function(data) {
        //         if (data.status == 422) {
        //             var errors = $.parseJSON(data.responseText);
        //             $.each(errors.errors, function(key, value) {
        //                 $("#" + key + "_error").text(value[0]);
        //             });
        //         }
        //     }
        // });
    </script>
@endsection
