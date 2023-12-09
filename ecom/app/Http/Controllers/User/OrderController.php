<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
class OrderController extends Controller
{

    protected function createOder(){
        $order = new Order();
        $order->totalPrice = Cart::subtotal();
        $order->shippingFee = 20000;
        $order->discountID = 0;
        $order->discountCode = '';
        $order->discountPrice = 0;
        $order->grandPrice = Cart::subtotal();
        $order->paymentMethod = 'COD';
        $order->orderCreatedDate = date('Y-m-d H:i:s');
        $order->orderCompletedDate = date('Y-m-d H:i:s');
        $order->orderAddress = 'Hà Nội';
        $order->orderPhone = '0123456789';
        $order->paymentStatus = "unpaid";
        $order->orderStatus = 0;
        return $order;
    }

    protected function createOderDetail(){
        $list_products = Cart::content();
        $order_list = [];
        foreach($list_products as $item){
            $order_detail = new OrderDetail();
            $order_detail->productID = $item->id;
            $order_detail->productName = $item->name;
            $order_detail->productPrice = $item->price;
            $order_detail->productQuantity = $item->qty;
            $order_detail->productTotalPrice = $item->price * $item->qty;
            array_push($order_list, $order_detail);
        }
        return $order_list;
    }
    public function Index()
    {
        $order = $this->createOder();
        $order_list = $this->createOderDetail();
        return view('user.payment', ['order_list'=>$order_list, 'order'=>$order]);
    }

    public function storeOder(){

    }
}
