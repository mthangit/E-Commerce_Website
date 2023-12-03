@extends('admin.layouts.template')
@section('page_title')
PING - Category
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
            <a class="dropdown-item" href="{{ route('allsubcategory', ['status' => 'all']) }}">Hiển thị Tất cả</a>
            <a class="dropdown-item" href="{{ route('allsubcategory', ['status' => 'available']) }}">Chỉ hiển thị Available</a>
            <a class="dropdown-item" href="{{ route('allsubcategory', ['status' => 'unavailable']) }}">Chỉ hiển thị Unavailable</a>
          </div>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên danh mục con</th>
            <th>Trực thuộc danh mục </th>
            <th>Số sản phẩm</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($subcategories as $subcategory )
          <tr>
            <td>{{$subcategory->subCategoryID}}</td>
            <td>{{$subcategory->subCategoryName}}</td>
            <td>{{$subcategory->categoryName}} </td>
            <td>{{$subcategory->productCount}}</td>
            <td>@if($subcategory->isActive == 1)
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
              <a href="{{route('editsubcategory', $subcategory->subCategoryID)}}" class="btn btn-primary">Sửa</a>
              @if($subcategory->isActive == 1)
              <a href="{{route('deletesubcategory', $subcategory->subCategoryID)}}" class="btn btn-danger">Xóa</a>
              @else
              <button class="btn btn-warning" disabled>Xóa</button>
              @endif
            </td>
          </tr>
          @endforeach
          {{ $subcategories->links() }}
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
      window.location.href = "{{ route('searchsubcategory') }}?q=" + searchValue;
    });

    $("#resetButton").click(function() {
      // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
      $("#searchInput").val('');
      window.location.href = 'http://localhost:8000/admin/search-subcategory';
    })
  });
</script>
@endsection