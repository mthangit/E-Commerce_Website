<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    public function getAllMethod(){
        $Index = $this->Index();
        $getAllCategory = $this->getAllCategory();
        $get5category = $this->get5category();
    }

    public function Index(Request $request)
    {
        $products = Product::where('isActive', 1)->where('productInStock', '>', 0);
        $category_list = Category::where('categorySlug', $request->categorySlug)->first();
        $products = $products->where('productCategoryID', $category_list->categoryID);
        $brandsArray = [];
        if(!empty($request->get('brand'))){
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('productBrandID', $brandsArray);
        }
        $products = $products->paginate(12);
        return view('user.product_list_category', ['list_products' => $products, 'category_list' => $category_list, 'brandsArray' => $brandsArray]);
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
