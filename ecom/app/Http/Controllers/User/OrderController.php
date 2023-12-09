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

    protected function createOder($totalPrice){
        $order = new Order();
        $order->shippingFee = 20000;
        $order->grandPrice = $totalPrice;
        $order->totalPrice = $totalPrice;
        $order->paymentMethod = 'COD';
        $order->orderCreatedDate = date('Y-m-d H:i:s');
        $order->orderAddress = 'Hà Nội';
        $order->orderPhone = '0123456789';
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
        $data = Cart::content();
        return view('user.payment', ['order_list'=>$data]);
    }

    public function StoreOrder(Request $request){
        $totalPrice = $request->input('totalPrice');
        $order = $this->createOder($totalPrice);
        $order->save();
        $order_list = $this->createOderDetail();
        foreach($order_list as $item){
            $item->orderID = $order->orderID;
            $item->save();
        }
        Cart::destroy();
        return view('user.dashboard_user');
    }

public function OrderSuccess(){
        return view('user.dashboard_user');
    }
}
