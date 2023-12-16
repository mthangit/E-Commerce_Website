<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductDetail(Request $request){
        $product = Product::where('productSlug', $request->productSlug)->first();
        return view('user.product_detail', ['thisProduct' => $product]);
    }

    public function ProductListByKeyword(Request $request){
        $keyword = $request->input('keyword');
        $products = Product::where('productName', 'like', '%'.$keyword.'%');

        $brandsArray = [];
        if(!empty($request->get('brand'))){
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('productBrandID', $brandsArray);
        }
        $products = $products->paginate(12);


        return view('user.product_list_keyword', ['list_products' => $products, 'keyword' => $keyword, 'brandsArray' => $brandsArray]);
    }



}
