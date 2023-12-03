@extends('admin.layouts.template')
@section('page_title')
PING - Edit Category
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
                <form action="{{ route('updatecategory') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="categoryID" name="categoryID" value="{{$category_info->categoryID}}" />
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="categoryName" name="categoryName" value="{{$category_info->categoryName}} " />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="categoryImage">Category Image</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="categoryImage" name="categoryImage" value="{{$category_info->categoryImage}}" />
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-primary" onclick="showImage()">Show Image</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="newCategoryImage">New Category Image</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="newCategoryImage" name="newCategoryImage" style="display: none;" />
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
                            var imageUrl = document.getElementById('categoryImage').value;
                            if (imageUrl) {
                                var imagePreview = document.getElementById('imagePreview');
                                imagePreview.innerHTML = '<img src="' + imageUrl + '" style="max-width:100%;" />';
                                imagePreview.style.display = 'block';
                            }
                        }

                        function changeImage() {
                            var newImageInput = document.getElementById('newCategoryImage');
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
                        <label class="col-sm-2 col-form-label" for="categoryDescription">Category Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="categoryDescription" name="categoryDescription" value="{{$category_info->categoryDescription}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subCategoryCount">Sub Category Count</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="subCategoryCount" name="subCategoryCount" value="{{$category_info->subCategoryCount}}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="productCount">Product Count</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="productCount" name="productCount" value="{{$category_info->productCount}}" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="categoryCreatedDate">Category Created Date</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="categoryCreatedDate" name="categoryCreatedDate" value="{{$category_info->categoryCreatedDate}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="categoryModifiedDate">Category Modified Date</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="categoryModifiedDate" name="categoryModifiedDate" value="{{$category_info->categoryModifiedDate}}" />
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