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
        $products = $products->where('productSubCategoryID', $subCategory->subCategoryID)->where('productCategoryID', $category->categoryID);

        $brandsArray = [];
        if(!empty($request->get('brand'))){
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('productBrandID', $brandsArray);
        }
        $products = $products->paginate(12);

        return view('user.product_list_subcategory', ['subCategory' => $subCategory,'list_products' => $products, 'category' => $category, 'brandsArray' => $brandsArray]);
    }
}
