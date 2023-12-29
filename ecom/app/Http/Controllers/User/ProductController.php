<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductDetail(Request $request)
    {
        $product = Product::where('productSlug', $request->productSlug)->first();
        $ratings = ProductRating::where('productID', $product->productID)->get();
        $latestRatings = ProductRating::where('productID', $product->productID)
            ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo mới nhất đến cũ nhất
            ->take(5) // Giới hạn kết quả lấy về là 5 bản ghi
            ->get();
        $similarProducts = Product::where('productSubCategoryID', $product->productSubCategoryID)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $averageRating = $ratings->avg('rating');

        $ratingDistribution = $ratings->groupBy('rating')->map(function ($item, $key) {
            return [
                'rating' => $key,
                'count' => $item->count(),
            ];
        })->sortByDesc('rating')->values();

        return view('user.product_detail', ['thisProduct' => $product, 'ratings' => $ratings, 'similarProducts' => $similarProducts, 'averageRating' => $averageRating, 'ratingDistribution' => $ratingDistribution, 'latestRatings' => $latestRatings]);
    }

    public function ProductListByKeyword(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('productName', 'like', '%' . $keyword . '%')->where('isActive', 1)->where('productInStock', '>', 0);

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


        return view('user.product_list_keyword', ['list_products' => $products, 'keyword' => $keyword, 'brandsArray' => $brandsArray, 'pricerange' => $pricerange, 'sortValue' => $sortValue]);
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
