@extends('admin.layouts.template')
@section('page_title')
PING - brand
@endsection
@section('content')
<!-- Contextual Classes -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thương hiệu</h4>
    <div class="card">
        <h5 class="card-header">Thông tin thương hiệu</h5>
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
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Lọc theo Trạng thái
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filterDropdown">
                        <a class="dropdown-item" href="{{ route('allbrand', ['status' => 'all']) }}">Hiển thị Tất cả</a>
                        <a class="dropdown-item" href="{{ route('allbrand', ['status' => 'available']) }}">Chỉ hiển thị
                            Available</a>
                        <a class="dropdown-item" href="{{ route('allbrand', ['status' => 'unavailable']) }}">Chỉ hiển
                            thị Unavailable</a>
                    </div>
                </div>
                <button class="btn btn-outline-secondary" type="button" id="addBrand">Thêm thương hiệu</button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên thương hiệu</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->brandID }} </td>
                        <td>{{ $brand->brandName }}</td>
                        <td>
                            @if ($brand->isActive == 1)
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
                            <a href="{{ route('editbrand', $brand->brandID) }}" class="btn btn-primary">Sửa</a>
                            @if($brand->isActive == 1)
                            <a href="{{ route('deletebrand', $brand->brandID) }}" class="btn btn-danger delete-brand">Xóa</a>
                            @else
                            <button class="btn btn-warning" disabled>Xóa</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    {{ $brands->links() }}
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/ Contextual Classes -->
@endsection
@section('customJS')
<script>
    $(document).ready(function() {
        $("#searchButton").click(function() {
            var searchValue = $("#searchInput").val();
            window.location.href = "{{ route('searchbrand') }}?q=" + searchValue;
        });

        $("#resetButton").click(function() {
            // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
            $("#searchInput").val('');
            window.location.href = "{{ route('allbrand') }}";
        });

        $("#addBrand").click(function() {
            // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
            $("#addBrand").val('');
            window.location.href = "{{ route('addbrand') }}";
        });
    });

    $(document).ready(function() {
        $('.delete-brand').on('click', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');

            // Hiển thị hộp thoại xác nhận
            if (confirm('Bạn có chắc chắn muốn xóa không?')) {
                // Nếu người dùng đồng ý, chuyển hướng đến URL xóa
                window.location.href = deleteUrl;
            }
        });
    });
</script>
@endsection