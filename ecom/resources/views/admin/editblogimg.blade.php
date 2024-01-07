@extends('admin.layouts.template')
@section('page_title')
    PING - Edit Image Blog
@endsection
@section('content')
    <!-- Content -->
<style>
    .image-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-container .delete-image {
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        padding: 5px;
        cursor: pointer;
    }

    .image-container .delete-image:hover {
        background-color: darkred;
    }
</style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm Hình Ảnh Blog</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Thêm hình ảnh</h5>
                    <small class="text-muted float-end">Nhập thông tin</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateblogimg') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">ảnh cũ</label>
                            <div class="col-sm-10 image-container">
                                <img src="{{ asset($blog_info->blogImage) }}" alt="" />
                            </div>
                        </div>

                        <input type="hidden" value="{{ $blog_info->blogID }}" name="blogID">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="blogImage" id="blogImage" />
                            </div>
                        </div>



                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cập nhật hình ảnh</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
