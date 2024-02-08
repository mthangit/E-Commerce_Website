<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    public function getAllMethod()
    {
        // $Index = $this->Index();
        // $getAllCategory = $this->getAllCategory();
        // $get5category = $this->get5category();
    }

    public function Index(Request $request)
    {
        $products = Product::where('isActive', 1)->where('productInStock', '>', 0);
        $category_list = Category::where('categorySlug', $request->categorySlug)->first();
        $products = $products->where('productCategoryID', $category_list->categoryID);

        $brandsArray = [];
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            for ($i = 0; $i < count($brandsArray); $i++) {
                $brand = Brand::where('brandName', $brandsArray[$i])->first();
                $brandsArray[$i] = $brand->brandID;
            }
            $products = $products->whereIn('productBrandID', $brandsArray);
        }

        $pricerange = [];
        if (!empty($request->get('price'))) {
            $pricerange = explode(',', $request->get('price'));
            $products = $this->filterProductsByPrice($products, $pricerange);
            // dd($products);
        }

        $sortValue = "Default";
        if (!empty($request->get("sort"))) {
            $sortValue = $request->get("sort");
            if ($sortValue == "asc") {
                $products = $products->orderBy('productDiscountPrice', 'asc');
            } elseif ($sortValue == "desc") {
                $products = $products->orderBy('productDiscountPrice', 'desc');
            } elseif ($sortValue == "a-z") {
                $products = $products->orderBy('productName', 'asc');
            }
        }


        $products = $products->paginate(12);
        return view('user.product_list_category', ['list_products' => $products, 'category_list' => $category_list, 'brandsArray' => $brandsArray, 'pricerange' => $pricerange, 'sortValue' => $sortValue]);
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

    protected function filterProductsByPrice($query, $priceRanges)
    {
        return $query->where(function ($q) use ($priceRanges) {
            foreach ($priceRanges as $range) {
                // Kiểm tra giá trị ngoại lệ "duoi300"
                if ($range === 'duoi300') {
                    $q->orWhere('productDiscountPrice', '<', 300000);
                }
                // Kiểm tra giá trị ngoại lệ "tren2trieu"
                elseif ($range === 'tren2trieu') {
                    $q->orWhere('productDiscountPrice', '>=', 2000000);
                }
                // Xử lý như bình thường với các khoảng giá khác
                else {
                    list($min, $max) = explode('-', $range);
                    $q->orWhereBetween('productDiscountPrice', [$min * 1000, $max * 1000]);
                }
            }
        });
    }

}
