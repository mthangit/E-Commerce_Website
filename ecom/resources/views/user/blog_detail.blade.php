@include('user.layouts.template_header_logged')

<div class="page-navigation">
    <ul class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li>Tên cẩm nang</li>
    </ul>
</div>

<div class="blog-area section-space-y-axis-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-detail-item">
                    <div class="blog-img" >
                        <img class="" src="{{ asset($blog->blogImage) }}" alt="Blog Image">
                    </div>
                    <div class="blog-content text-start pb-0">
                        <div class="blog-meta text-dim-gray pb-3">
                            <ul>
                                <li class="date"><i class="fa fa-calendar-o me-2"></i>Ngày đăng:
                                    {{ $blog->blogCreatedDate }}</li>
                            </ul>
                        </div>
                        <h5 class="txt-center txt-cyan section-txt-title txt-bold">{{ $blog->blogTitle }}</h5>
                        <p style="text-align: justify; text-indent: 20px; line-height: 30px; padding: 20px;">
                            {{ $blog->blogContent }}
                        </p>
                    </div>
                    <div class="blog-return" style="margin-bottom: 50px;">
                        <a href="{{ route('blog') }}" class="txt-cyan orange-link">Quay về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.template_footer')
