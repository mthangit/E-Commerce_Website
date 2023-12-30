@extends('admin.layouts.template')
@section('page_title')
    PING - product
@endsection
@section('content')
    <!-- Contextual Classes -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sản phẩm</h4>
        <div class="card">
            <h5 class="card-header">Danh sách sản phẩm</h5>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tìm kiếm danh mục" id="searchInput">
                    <button class="btn btn-outline-secondary" type="button" id="searchButton">Tìm kiếm</button>
                    <button class="btn btn-outline-secondary" type="button" id="resetButton">Reset</button>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Lọc theo Trạng thái
                        </button>
                        <div class="dropdown-menu" aria-labelledby="filterDropdown">
                            <a class="dropdown-item" href="{{ route('allproduct', ['status' => 'all']) }}">Hiển thị Tất
                                cả</a>
                            <a class="dropdown-item" href="{{ route('allproduct', ['status' => 'available']) }}">Chỉ hiển
                                thị Available</a>
                            <a class="dropdown-item" href="{{ route('allproduct', ['status' => 'unavailable']) }}">Chỉ hiển
                                thị Unavailable</a>
                        </div>
                    </div>
                    <button class="btn btn-outline-secondary" type="button" id="addProduct">Thêm sản phẩm</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->productID }} </td>
                                <td>{{ $product->productName }}</td>
                                <td>{{ $product->productSubCategoryName }}</td>
                                <td><img style="height:100px" src="{{ asset($product->productImage) }}" alt=""></td>
                                <td>
                                    @if ($product->isActive == 1)
                                        <div class="d-flex align-items-center">
                                            <div class="badge badge-success badge-dot m-r-10"></div>
                                            <div>Available</div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <div class="badge badge-danger badge-dot m-r-10"></div>
                                            <div style="color: #999; font-style: italic;">Unavailable</div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('editproduct', $product->productID) }}"
                                        class="btn btn-primary">Sửa</a>
                                    @if ($product->isActive == 1)
                                        <a href="{{ route('deleteproduct', $product->productID) }}"
                                            class="btn btn-danger btn-delete"
                                            data-url="{{ route('deleteproduct', $product->productID) }}">Xóa</a>
                                    @else
                                        <button class="btn btn-warning" disabled>Xóa</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        {{ $products->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Contextual Classes -->
@endsection
@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchButton").click(function() {
                applyFilter();
            });

            $("#resetButton").click(function() {
                // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
                $("#searchInput").val('');
                window.location.href = "{{ route('allproduct') }}";
            })

            $("#addProduct").click(function() {
                $("#addProduct").val('');
                window.location.href = "{{ route('addproduct') }}";
            });

            function applyFilter() {
                var searchValue = $("#searchInput").val();
                window.location.href = "{{ route('allproduct') }}?search=" + searchValue + "&status=all";
            }

        });

        $(document).ready(function() {
            $(".btn-delete").click(function(e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('data-url');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm này không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                })
            });
        });
    </script>
@endsection
