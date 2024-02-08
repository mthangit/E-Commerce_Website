<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogDetail(Request $request)
    {

        $blogSlug = $request->blogSlug;

        $blog = Blog::where("blogSlug", $blogSlug)->first();

        return view('user.blog_detail', compact('blog'));
    }
}
