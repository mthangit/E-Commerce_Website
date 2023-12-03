@extends('admin.layouts.template')
@section('page_title')
PING - Edit Sub Category
@endsection
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sửa danh mục sản phẩm</h4>
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
                    <input type="hidden" class="form-control" id="subCategoryID" name="subCategoryID" value="{{$subCategoryInfo->subCategoryID}}" />
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subCategoryName" name="subCategoryName" value="{{$subCategoryInfo->subCategoryName}} " />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subCategoryImage">Category Image</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="subCategoryImage" name="subCategoryImage" value="{{$subCategoryInfo->subCategoryImage}}" />
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" onclick="showImage()">Show Image</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="newsubCategoryImage">New Category Image</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="newsubCategoryImage" name="newsubCategoryImage" style="display: none;" />
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-secondary" onclick="changeImage()">Upload New Image</button>
                        </div>
                    </div>

                    <div id="imagePreview" style="display: none;">
                        <!-- Image preview will be displayed here -->
                    </div>

                    <script>
                        function showImage() {
                            var imageUrl = document.getElementById('subCategoryImage').value;
                            if (imageUrl) {
                                var imagePreview = document.getElementById('imagePreview');
                                imagePreview.innerHTML = '<img src="' + imageUrl + '" style="max-width:100%;" />';
                                imagePreview.style.display = 'block';
                            }
                        }

                        function changeImage() {
                            var newImageInput = document.getElementById('newsubCategoryImage');
                            newImageInput.click();

                            newImageInput.addEventListener('change', function() {
                                var imagePreview = document.getElementById('imagePreview');
                                var newImageUrl = URL.createObjectURL(newImageInput.files[0]);
                                imagePreview.innerHTML = '<img src="' + newImageUrl + '" style="max-width:100%;" />';
                                imagePreview.style.display = 'block';
                            });
                        }
                    </script>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subCategoryDescription">Category Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subCategoryDescription" name="subCategoryDescription" value="{{$subCategoryInfo->subCategoryDescription}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="productCount">Product Count</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="productCount" name="productCount" value="{{$subCategoryInfo->productCount}}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subCategoryCreateDate">Category Created Date</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="subCategoryCreateDate" name="subCategoryCreateDate" value="{{$subCategoryInfo->subCategoryCreateDate}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subCategoryModifiedDate">Category Modified Date</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="subCategoryModifiedDate" name="subCategoryModifiedDate" value="{{$subCategoryInfo->subCategoryModifiedDate}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Trạng thái sản phẩm</label>
                        <div class="switch m-r-10">
                            <input type="checkbox" id="isActive" name="isActive" checked="">
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