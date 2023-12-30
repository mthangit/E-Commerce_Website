@extends('admin.layouts.template')
@section('page_title')
PING - THÊM BLOG
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Thêm bài đăng</h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Thêm bài đăng</h5>
                <small class="text-muted float-end">Nhập thông tin</small>
            </div>
            <div class="card-body">
                <form action="{{route('storeblog')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập tiêu đề</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="blogTitle" name="blogTitle" placeholder="Tết đến xuân về" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" name="blogImage" id="blogImage" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập intro</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="blogIntro" name="blogIntro" placeholder="Intro ở đây" />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nhập nội dung</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="blogContent" name="blogContent" placeholder="nhập nội dung"></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Thêm bài đăng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
