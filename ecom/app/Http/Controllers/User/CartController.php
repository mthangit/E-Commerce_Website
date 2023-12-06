<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request){
        $product = Product::find($request->productID);
        $quantity = $request->quantity;
        if($product == null){
            return $this->reponse()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ]);
        }
        if(Cart::count() > 0){
            // check if product exist in cart then increase qty and plus the price else add new product
            $cart = Cart::content();
            foreach($cart as $item){
                if($item->id == $product->productID){
                    $quantityItem = $item->qty + $quantity;
                    if($product->isFlashSale == 1){
                        $price = $product->productDiscountPrice;
                    } else {
                        $price = $product->productOriginalPrice;
                    }
                    $price = $price * $quantityItem;
                    Cart::update($item->rowId, ['qty' => $quantityItem, 'price' => $price]);
                    $status = true;
                    $message = 'Thêm sản phẩm vào giỏ hàng thành công';
                    break;
                } else {
                    if($product->isFlashSale == 1){
                        $price = $product->productDiscountPrice;
                    } else {
                        $price = $product->productOriginalPrice;
                    }
                    // add to cart with image alse
                    Cart::add([
                        'id' => $product->productID,
                        'name' => $product->productName,
                        'qty' => $quantity,
                        'price' => $price * $quantity,
                    ]);
                    $status = true;
                    $message = 'Thêm sản phẩm vào giỏ hàng thành công';
                }
            }
        } else {
            if($product->isFlashSale == 1){
                $price = $product->productDiscountPrice;
            } else {
                $price = $product->productOriginalPrice;
            }
            // add to cart with image alse
            Cart::add([
                'id' => $product->productID,
                'name' => $product->productName,
                'qty' => $quantity,
                'price' => $price * $quantity,
            ]);
            $status = true;
            $message = 'Thêm sản phẩm vào giỏ hàng thành công';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
    public function Index()
    {
        $data = Cart::content();
        $products = [];
        foreach($data as $item){
            $product = Product::find($item->id);
            $product->qty = $item->qty;
            $product->TotalPrice = $item->price;
            $product->rowId = $item->rowId;
            array_push($products, $product);
        }
        return view('user.cart', ['products' => $products]);
    }

}
