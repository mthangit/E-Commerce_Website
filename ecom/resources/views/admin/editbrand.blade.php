@extends('admin.layouts.template')
@section('page_title')
    PING - Edit Brand
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa thương hiệu
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Sửa thương hiệu</h5>
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
                        <form action="{{ route('updatebrand') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="brandID" name="brandID"
                                value="{{ $brandInfo->brandID }}" />
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tên thương hiệu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="brandName" name="brandName"
                                        value="{{ $brandInfo->brandName }} " />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="brandDescription">Brand Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="brandDescription" name="brandDescription"
                                        value="{{ $brandInfo->brandDescription }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái thương
                                    hiệu</label>
                                <div class="switch m-r-10">
                                    <input type="checkbox" id="isActive" name="isActive"
                                        {{ $brandInfo->isActive ? 'checked' : '' }}>
                                    <label for="isActive"></label>
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
