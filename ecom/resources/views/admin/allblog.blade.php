@extends('admin.layouts.template')
@section('page_title')
    PING - BLOG
@endsection
@section('content')
    <!-- Contextual Classes -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Quản lý blog</h4>
        <div class="card">
            <h5 class="card-header">Thông tin blog</h5>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tìm kiếm danh mục" id="searchInput">
                    <button class="btn btn-secondary" type="button" id="searchButton">Tìm kiếm</button>
                    <button class="btn btn-outline-secondary" type="button" id="resetButton">Reset</button>
                    <button class="btn btn-outline-secondary btn-success" type="button" id="addBlog">Thêm bài
                        đăng</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->blogID }}</td>
                                <td>{{ $blog->blogTitle }}</td>
                                <td>{{ $blog->blogCreatedDate }} </td>
                                <td>{{ $blog->blogModifiedDate }}</td>
                                <td>
                                    <a href="{{ route('editblog', $blog->blogID) }}" class="btn btn-primary">Sửa</a>
                                    <a href="{{ route('deleteblog', $blog->blogID) }}" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        {{ $blogs->links() }}
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
                window.location.href = "{{ route('searchblog') }}?q=" + searchValue;
            });

            $("#resetButton").click(function() {
                // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
                $("#searchInput").val('');
                window.location.href = "{{ route('allblog') }}";
            });

            $("#addBlog").click(function() {
                // Reset giá trị ô tìm kiếm và chuyển hướng trang về URL cụ thể
                $("#addBlog").val('');
                window.location.href = "{{ route('addblog') }}";
            });


        });
    </script>
@endsection
