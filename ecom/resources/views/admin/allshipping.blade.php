@extends('admin.layouts.template')
@section('page_title')
PING - discount
@endsection
@section('content')
<!-- Contextual Classes -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Quản lý chi phí ship</h4>
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
        <button class="btn btn-outline-secondary" type="button" id="addShipping">Thêm thị trường</button>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tỉnh thành</th>
            <th>GIÁ</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($shippings as $shipping )
          <tr>
            <td>{{$shipping->shippingID}}</td>
            <td>
                @foreach ($provinces as $province)
                    @if ($province->provinceID == $shipping->provinceID)
                        {{$province->provinceName}}
                    @endif
                @endforeach
            </td>
            <td>{{$shipping->shippingExpense}} </td>
            <td>
              <a href="{{route('editshipping', $shipping->shippingID)}}" class="btn btn-primary">Sửa</a>
              <a href="{{route('deleteshipping', $shipping->shippingID)}}" class="btn btn-danger">Xóa</a>
            </td>
          </tr>
          @endforeach
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
      window.location.href = "{{ route('searchshipping') }}?q=" + searchValue;
    });

    $("#resetButton").click(function() {
      // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
      $("#searchInput").val('');
      window.location.href = 'http://localhost:8000/admin/search-shipping';
    });

    $("#addShipping").click(function() {
      // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
      $("#addShipping").val('');
      window.location.href = "{{ route('addshipping') }}";
    })


  });
</script>
@endsection
