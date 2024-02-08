@extends('admin.layouts.template')
@section('page_title')
    PING - SỬA BLOG
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa bài đăng</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Sửa bài đăng</h5>
                    <small class="text-muted float-end">Sửa thông tin</small>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('updateblog') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="blogID" name="blogID"
                            value="{{ $blog_info->blogID }}" />
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Title </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="blogTitle" name="blogTitle"
                                    value="{{ $blog_info->blogTitle }} " />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Chèn hình</label>
                            <div class="col-sm-10">
                                @if ($blog_info->blogImage)
                                    <img style="height:100px" src="{{ asset($blog_info->blogImage) }}"
                                        alt="">
                                    <button type="button" class="btn btn-primary" onclick="updateImage()">cập nhật
                                        ảnh</button>
                                @endif
                                <input type="hidden" name="deleteImage" id="deleteImageInput" value="0">
                            </div>
                        </div>

                        <script>
                            function updateImage() {
                                window.location.href = "{{ route('editblogimg', $blog_info->blogID) }}";
                            }
                        </script>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="blogDescription">Intro</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="blogIntro" name="blogIntro"
                                    value="{{ $blog_info->blogIntro }}" />
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="blogDescription">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="blogContent" name="blogContent">{{ $blog_info->blogContent }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="blogCreatedDate">Ngày tạo</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="blogCreatedDate"
                                    name="blogCreatedDate" value="{{ $blog_info->blogCreatedDate }}" readonly />
                            </div>
                        </div>


                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
