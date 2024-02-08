@include('user.layouts.template_header_logged')
<div class="page-navigation">
    <ul class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li>Cẩm nang</li>
    </ul>
</div>

<div class="container" style="margin-bottom: 80px; text-align: justify;">
    <!-- section title -->
    <h1 class="section-txt-title txt-center txt-bold">Cẩm nang</h1>
    <!-- section title ends -->
    <div class="row ">
        @foreach ($allblogs as $blog)
            <div class="col-md-6">
                <div class="media blog-media" style="max-width:500px; height:auto">
                    <a href="{{ route('blog.detail', ['blogSlug' => $blog->blogSlug]) }}"><img class="d-flex"
                            src="{{ asset($blog->blogImage) }}" alt="" width="250px" height="250px"></a>
                    <div class="media-body">
                        <a href="{{ route('blog.detail', ['blogSlug' => $blog->blogSlug]) }}">
                            <h5 class="mt-0 txt-cyan">{{ $blog->blogTitle }}</h5>
                        </a>
                        {{ $blog->blogIntro }}
                        <a href="{{ route('blog.detail', ['blogSlug' => $blog->blogSlug]) }}"
                            class="post-link cyan-link">Read More</a>
                        <ul>
                            <li>Ngày đăng: {{ $blog->blogCreatedDate }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('user.layouts.template_footer')
