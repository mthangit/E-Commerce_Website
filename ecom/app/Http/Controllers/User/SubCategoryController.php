<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class SubCategoryController extends Controller
{
    public function Index(Request $request)
    {
        $products = Product::where('isActive', 1)->where('productInStock', '>', 0);
        $category = Category::where('categorySlug', $request->categorySlug)->first();
        $subCategory = SubCategory::where('subCategorySlug', $request->subCategorySlug)->first();
        $products = $products->where('productSubCategoryID', $subCategory->subCategoryID)->where('productCategoryID', $category->categoryID)->get();
        return view('user.product_list_subcategory', ['subCategory' => $subCategory,'list_products' => $products, 'category' => $category]);
    }
    public function Index2(Request $request)
    {
        $products = Product::where('isActive', 1)->where('productInStock', '>', 0);
        $category_list = Category::where('categorySlug', $request->categorySlug)->first();
        $products = $products->where('productCategoryID', $category_list->categoryID)->get();
        return view('user.product_list_category', ['list_products' => $products, 'category_list' => $category_list]);
    }
    public function get5SubCategory()
    {
        $subCategory = SubCategory::take(5)->get();
        return view('user.product_list', ['subCategory_header' => $subCategory]);
    }
}
