<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\Product;
use App\Models\Order;
use App\Models\Discount;
use App\Models\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected function createOder($totalPrice, $paymentMethod, $discountValidCode){
        $order = new Order();
        $discount = Discount::where('discountCode', $discountValidCode)->first();
        $discountPrice = 0;

        if($discount){
            if($discount->discountType == 'percent'){
                $discountPrice = $totalPrice * $discount->discountAmount / 100;
            }
            else{
                $discountPrice = $discount->discountAmount;
            }

            $discount->discountQuantity = $discount->discountQuantity - 1;
            $discount->discountUsed = $discount->discountUsed + 1;
            $order->discountID = $discount->discountID;
            $order->discountCode = $discount->discountCode;
            $order->discountPrice = $discountPrice;
            $discount->save();
        }
        $order->orderCustomerName = 'Nguyễn Văn A';
        $order->shippingFee = 20000;
        $order->grandPrice = $totalPrice - $discountPrice;
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
        $info = CustomerInfo::where('userID', Auth::user()->id)->first();
        if($info->customerPhone == null){
            $info->customerPhone = '0123456789';
        }
        if($info->customerAddress == null){
            $info->customerAddress = 'Thủ Đức, TPHCM';
        }
        $data = Cart::content();
        return view('user.payment', ['order_list'=>$data, 'info'=>$info]);
    }
    public function StoreOrder(Request $request){
        $totalPrice = intval($request->input('totalPrice'));
        $paymentMethod = $request->input('paymentMethod');
        $discountValidCode = $request->input('discountValidCode');
        $order = $this->createOder($totalPrice, $paymentMethod, $discountValidCode);
        $order->save();
        $order_list = $this->createOderDetail();
        foreach($order_list as $item){
            $item->orderID = $order->orderID;
            $item->save();
        }
        Cart::destroy();
        return response()->json(['orderID' => $order->orderID]);
    }

    public function OrderSuccess(Request $request){
        $orderID = $request->orderID;
        $order = Order::find($orderID);
        $order_list = OrderDetail::where('orderID', $orderID)->get();
        return view('user.OrderSuccess', ['order'=>$order, 'order_list'=>$order_list]);
    }
}
