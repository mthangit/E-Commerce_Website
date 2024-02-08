<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use App\Models\Brand;

class SubCategoryController extends Controller
{
    public function Index(Request $request)
    {
        $products = Product::where('isActive', 1)->where('productInStock', '>', 0);
        $category = Category::where('categorySlug', $request->categorySlug)->first();
        $subCategory = SubCategory::where('subCategorySlug', $request->subCategorySlug)->first();
        $products = $products->where('productSubCategoryID', $subCategory->subCategoryID)->where('productCategoryID', $category->categoryID);

        $brandsArray = [];
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            // convert $brandsArray from name to id
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

        return view('user.product_list_subcategory', ['subCategory' => $subCategory, 'list_products' => $products, 'category' => $category, 'brandsArray' => $brandsArray, 'pricerange' => $pricerange, 'sortValue' => $sortValue]);
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
