@extends('admin.layouts.template')
@section('page_title')
PING - Product
@endsection
@section('content')

<!-- Content Wrapper START -->
<div class="main-content">
  <div class="page-header">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sản phẩm</h4>
    @if(session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message') }}
    </div>
    @endif
  </div>
  <div class="card">
    <div class="card-body">
      <div class="row m-b-30">
        <div class="col-lg-8">
          <div class="d-md-flex">
            <div class="m-b-10 m-r-15">
              <select class="custom-select" style="min-width: 180px;">
                <option selected>Catergory</option>
                <option value="all">All</option>
                <option value="homeDeco">Home Decoration</option>
                <option value="eletronic">Eletronic</option>
                <option value="jewellery">Jewellery</option>
              </select>
            </div>
            <div class="m-b-10">
              <select class="custom-select" style="min-width: 180px;">
                <option selected>Status</option>
                <option value="all">All</option>
                <option value="inStock">In Stock </option>
                <option value="outOfStock">Out of Stock</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-4 text-right">
          <button class="btn btn-primary" onclick="sortTable()">
            <i class="anticon anticon-plus-circle m-r-5"></i>
            <span>Add Product</span>
          </button>
        </div>
      </div>
      <div class="table-responsive">
        <!-- <div class="d-flex justify-content-between mb-3">
           <div> -->
            <!-- <label for="sortColumn">Chọn cột sắp xếp:</label> -->
            <!-- <select id="sortColumn" class="form-control"> -->
              <!-- <option value="checkbox">Checkbox</option>
              <option value="id">ID</option>
              <option value="product">Product</option>
              <option value="category">Category</option>
              <option value="price">Price</option>
              <option value="stock">Stock Left</option>
              <option value="status">Status</option>
            </select>
          </div> -->
          <!-- <div>
            <label for="sortOrder">Chọn thứ tự:</label>
            <select id="sortOrder" class="form-control">
              <option value="asc">Tăng dần</option>
              <option value="desc">Giảm dần</option>
            </select>
          </div> -->
          <!-- <div>
            
            <button class="btn btn-primary" onclick="sortTable()">Sắp xếp</button>
          </div> -->
        <!-- </div> -->
        <table class="table table-hover e-commerce-table">
          <thead>
            <tr>
              <th class="sortable" data-column="checkbox">
                <div class="checkbox">
                  <input id="checkAll" type="checkbox">
                  <label for="checkAll" class="m-b-0"></label>
                </div>
              </th>
              <th class="sortable" data-column="id">ID</th>
              <th class="sortable" data-column="product">Product</th>
              <th class="sortable" data-column="category">Category</th>
              <th class="sortable" data-column="price">Price</th>
              <th class="sortable" data-column="stock">Stock Left</th>
              <th class="sortable" data-column="status">Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product )
            <tr>
              <td>
                <div class="checkbox">
                  <input id="check-item-1" type="checkbox">
                  <label for="check-item-1" class="m-b-0"></label>
                </div>
              </td>
              <td>
                {{$product ->productID}}
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="max-width: 60px" alt="">
                  <h6 class="m-b-0 m-l-10">{{$product ->productName}}</h6>
                </div>
              </td>
              <td>{{$product ->productSubCategoryName}}</td>
              <td>{{$product ->productOriginalPrice}}</td>
              <td>
                <img style="height:100px" src="{{asset($product->productImage)}}" alt="">
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="badge badge-success badge-dot m-r-10"></div>
                  <div>In Stock</div>
                </div>
              </td>
              <td class="text-right">
                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                  <i class="anticon anticon-edit"></i>
                </button>
                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                  <i class="anticon anticon-delete"></i>
                </button>
              </td>
            </tr>
            @endforeach
            <!-- Hiển thị phân trang -->
           {{ $products->links() }}
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  // Di chuyển hàm sortTable ra khỏi sự kiện click
  function sortTable() {
    var column = $('#sortColumn').val();
    var order = $('#sortOrder').val();

    // Sắp xếp bảng dựa trên cột và hướng sắp xếp
    var tbody = $('table tbody');
    var rows = tbody.find('tr').toArray().sort(comparator(column, order));

    // Đảo ngược thứ tự nếu hướng là desc
    if (order === 'desc') {
      rows = rows.reverse();
    }

    // Chèn các dòng đã sắp xếp vào tbody
    tbody.empty();
    for (var i = 0; i < rows.length; i++) {
      tbody.append(rows[i]);
    }
  }

  function comparator(column, order) {
    return function (a, b) {
      var valA = getCellValue(a, column);
      var valB = getCellValue(b, column);

      return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
    };
  }

  function getCellValue(row, column) {
    return $(row).children('td').eq(getColumnIndex(column)).text();
  }

  function getColumnIndex(column) {
    return $('table thead th[data-column="' + column + '"]').index();
  }
</script>
@endsection
