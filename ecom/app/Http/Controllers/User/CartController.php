<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $product = Product::find($request->productID);
        $quantity = $request->quantity;
        if ($product == null) {
            return $this->reponse()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ]);
        }
        if (Cart::count() > 0) {
            // check if product exist in cart then increase qty and plus the price else add new product
            $cart = Cart::content();
            foreach ($cart as $item) {
                if ($item->id == $product->productID) {
                    $quantityItem = $item->qty + $quantity;
                    if ($product->isFlashSale == 1) {
                        $price = $product->productDiscountPrice;
                    } else {
                        $price = $product->productOriginalPrice;
                    }
                    Cart::update($item->rowId, ['qty' => $quantityItem, 'price' => $price]);
                    $status = true;
                    $message = 'Thêm sản phẩm vào giỏ hàng thành công';
                    notify()->success('Laravel Notify is awesome!');
                    break;
                } else {
                    if ($product->isFlashSale == 1) {
                        $price = $product->productDiscountPrice;
                    } else {
                        $price = $product->productOriginalPrice;
                    }
                    // add to cart with image alse
                    Cart::add([
                        'id' => $product->productID,
                        'name' => $product->productName,
                        'qty' => $quantity,
                        'price' => $price,
                    ]);
                    $status = true;
                    $message = 'Thêm sản phẩm vào giỏ hàng thành công';

                }
            }
        } else {
            if ($product->isFlashSale == 1) {
                $price = $product->productDiscountPrice;
            } else {
                $price = $product->productOriginalPrice;
            }
            // add to cart with image alse
            Cart::add([
                'id' => $product->productID,
                'name' => $product->productName,
                'qty' => $quantity,
                'price' => $price,
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
        return view('user.cart', ['products' => $data]);
    }

    public function DeleteCart(Request $request)
    {
        $rowID = $request->rowID;
        Cart::remove($rowID);

        $totalPriceCart = Cart::subtotal();

        //convert $totalPriceCart from string to int
        $totalPriceCart = intval(str_replace(',', '', $totalPriceCart));

        return response()->json([
            'status' => true,
            'totalPriceCart' => $totalPriceCart,
        ]);
    }
    public function UpdateCart(Request $request)
    {
        $rowID = $request->rowID;
        $quantity = $request->qty;
        Cart::update($rowID, $quantity);

        $totalPriceProduct = Cart::get($rowID)->price * $quantity;

        $totalPriceCart = Cart::subtotal();

        //convert $totalPriceCart from string to int
        $totalPriceCart = intval(str_replace(',', '', $totalPriceCart));

        return response()->json([
            'status' => true,
            'totalPriceProduct' => $totalPriceProduct,
            'totalPriceCart' => $totalPriceCart,
        ]);
    }
}
