@extends('admin.layouts.template')
@section('page_title')
    PING - Edit Sub Category
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa danh mục sản phẩm con</h4>
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
                    <form action="{{ route('updatesubcategory') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="subCategoryID" name="subCategoryID"
                            value="{{ $subCategoryInfo->subCategoryID }}" />
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subCategoryName" name="subCategoryName"
                                    value="{{ $subCategoryInfo->subCategoryName }} " />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">lựa chọn danh mục cha</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="categoryID" name="categoryID"
                                    value="{{ $subCategoryInfo->categoryName }}">
                                    <option value="{{ $subCategoryInfo->categoryName }}">
                                        {{ $subCategoryInfo->categoryName }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->categoryID }}">{{ $category->categoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="subCategoryDescription">Category Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subCategoryDescription"
                                    name="subCategoryDescription" value="{{ $subCategoryInfo->subCategoryDescription }}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="subCategoryCreateDate">SubCategory Created
                                Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="subCategoryCreatedDate"
                                    name="subCategoryCreatedDate" value="{{ $subCategoryInfo->subCategoryCreatedDate }}"
                                    readonly />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="subCategoryModifiedDate">SubCategory Modified
                                Date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="subCategoryModifiedDate"
                                    name="subCategoryModifiedDate" value="{{ $subCategoryInfo->subCategoryModifiedDate }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái danh mục con</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive" {{ $subCategoryInfo->isActive ? 'checked' : '' }}>
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
