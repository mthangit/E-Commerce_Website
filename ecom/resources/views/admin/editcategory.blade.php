@extends('admin.layouts.template')
@section('page_title')
    PING - Edit Category
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa danh mục sản phẩm cha</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Sửa danh mục</h5>
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
                    <form action="{{ route('updatecategory') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="categoryID" name="categoryID"
                            value="{{ $category_info->categoryID }}" />
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="categoryName" name="categoryName"
                                    value="{{ $category_info->categoryName }} " />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="categoryDescription">Category Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="categoryDescription"
                                    name="categoryDescription" value="{{ $category_info->categoryDescription }}" />
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="categoryCreatedDate">Category Created Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="categoryCreatedDate"
                                    name="categoryCreatedDate" value="{{ $category_info->categoryCreatedDate }}" readonly />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="categoryModifiedDate">Category Modified Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="categoryModifiedDate"
                                    name="categoryModifiedDate" value="{{ $category_info->categoryModifiedDate }}"
                                    readonly />
                            </div>
                        </div>

                   <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái danh mục</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive" {{ $category_info->isActive ? 'checked' : '' }}>
                            <label for="isActive"></label>
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
