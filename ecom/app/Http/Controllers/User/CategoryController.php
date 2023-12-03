<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllMethod(){
        $Index = $this->Index();
        $getAllCategory = $this->getAllCategory();
        $get5category = $this->get5category();
    }

    public function Index()
    {

        return view('user.product_list');
    }

    public function getCategoryBySlug($categorySlug)
    {
        $category = CategoryController::where('categorySlug', $categorySlug)->first();
        return view('user.product_list', ['category' => $category]);
    }

    public function get5category()
    {
        $category = Category::take(5)->get();
        return view('user.product_list', ['category_header' => $category]);
    }
}
