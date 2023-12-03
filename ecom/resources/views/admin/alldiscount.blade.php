@extends('admin.layouts.template')
@section('page_title')
PING - discount
@endsection
@section('content')
<!-- Contextual Classes -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Danh mục sản phẩm</h4>
  <div class="card">
    <h5 class="card-header">Thông tin danh mục con sản phẩm có sẵn</h5>
    @if(session()->has('message'))
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
            <a class="dropdown-item" href="{{ route('alldiscount', ['status' => 'all']) }}">Hiển thị Tất cả</a>
            <a class="dropdown-item" href="{{ route('alldiscount', ['status' => 'available']) }}">Chỉ hiển thị Available</a>
            <a class="dropdown-item" href="{{ route('alldiscount', ['status' => 'unavailable']) }}">Chỉ hiển thị Unavailable</a>
          </div>
        </div>
        <button class="btn btn-outline-secondary" type="button" id="addDiscount">Thêm mã giảm giá</button>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên mã giảm giá</th>
            <th>Code</th>
            <th>Loại mã giảm giá</th>
            <th>Giá trị</th>
            <th>Số lượng ban đầu</th>
            <th>Đã sử dụng</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($discounts as $discount )
          <tr @if($discount->isActive == 0) class="text-muted" @endif >
            <td>{{$discount->discountID}}</td>
            <td>{{$discount->discountName}}</td>
            <td>{{$discount->discountCode}} </td>
            <td>{{$discount->discountType}}</td>
            <td>{{$discount->discountAmount}}</td>
            <td>{{$discount->discountQuantity}}</td>
            <td>{{$discount->discountUsed}}</td>
            <td>@if($discount->isActive == 1)
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
              <a href="{{route('editdiscount', $discount->discountID)}}" class="btn btn-primary">Sửa</a>
              @if($discount->isActive == 1)
              <a href="{{route('deletediscount', $discount->discountID)}}" class="btn btn-danger">Xóa</a>
              @else
              <button class="btn btn-warning" disabled>Xóa</button>
              @endif
            </td>
          </tr>
          @endforeach
          {{ $discounts->links() }}
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
      window.location.href = "{{ route('searchdiscount') }}?q=" + searchValue;
    });

    $("#resetButton").click(function() {
      // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
      $("#searchInput").val('');
      window.location.href = 'http://localhost:8000/admin/search-discount';
    });

    $("#addDiscount").click(function() {
      // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
      $("#addDiscount").val('');
      window.location.href = 'http://localhost:8000/admin/add-discount';
    });

    
  });
</script>
@endsection