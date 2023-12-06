<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductDetail(Request $request){
        $product = Product::where('productSlug', $request->productSlug)->first();
        return view('user.product_detail', ['product' => $product]);
    }
}
