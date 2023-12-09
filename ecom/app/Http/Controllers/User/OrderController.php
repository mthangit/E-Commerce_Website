<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected function createOder($totalPrice, $paymentMethod){
        $order = new Order();
        $order->orderCustomerName = 'Nguyễn Văn A';
        $order->shippingFee = 20000;
        $order->grandPrice = $totalPrice;
        $order->totalPrice = $totalPrice;
        $order->paymentMethod = $paymentMethod;
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
        If(!Auth::check()){
            return redirect()->route('redirectToPayment');
        }
        $data = Cart::content();
        return view('user.payment', ['order_list'=>$data]);
    }

    public function StoreOrder(Request $request){
        $totalPrice = $request->input('totalPrice');
        $paymentMethod = $request->input('paymentMethod');
        $order = $this->createOder($totalPrice, $paymentMethod);
        $order->save();
        $order_list = $this->createOderDetail();
        foreach($order_list as $item){
            $item->orderID = $order->orderID;
            $item->save();
        }
        Cart::destroy();
        return redirect()->route('order Success');
    }

    public function OrderSuccess(){
        return view('user.OrderSuccess');
    }
}
