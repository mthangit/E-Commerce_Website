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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected function createHistory($orderID, $totalPrice, $paymentMethod)
    {
        $history = new PurchaseHistory();
        $history->customerID = CustomerInfo::where('userID', Auth::user()->id)->first()->customerID;
        $history->orderID = $orderID;
        $history->totalPrice = $totalPrice;
        $history->paymentMethod = $paymentMethod;
        return $history;
    }

    protected function createOder($totalPrice, $paymentMethod, $discountValidCode, $orderCustomerName, $orderAddress, $orderPhone, $paymentStatus)
    {
        $order = new Order();
        $discount = Discount::where('discountCode', $discountValidCode)->first();
        $discountPrice = 0;
        $shippingFee = 0;
        if ($discount) {
            if ($discount->discountType == 'percent') {
                $discountPrice = $totalPrice * $discount->discountAmount / 100;
            } else {
                $discountPrice = $discount->discountAmount;
            }

            $discount->discountQuantity = $discount->discountQuantity - 1;
            $discount->discountUsed = $discount->discountUsed + 1;
            $order->discountID = $discount->discountID;
            $order->discountCode = $discount->discountCode;
            $order->discountPrice = $discountPrice;
            $discount->save();
        }
        $order->orderID = time() . "";
        $order->customerID = CustomerInfo::where('userID', Auth::user()->id)->first()->customerID;
        $order->orderCustomerName = $orderCustomerName;
        $order->totalPrice = $totalPrice;
        if ($totalPrice > 250000) {
            $order->shippingFee = 0;
            $shippingFee = 0;
        } else {
            $order->shippingFee = 30000;
            $shippingFee = 30000;
        }
        $order->grandPrice = $totalPrice + $shippingFee - $discountPrice;
        $order->paymentMethod = "COD";
        $order->orderCreatedDate = now('Asia/Ho_Chi_Minh');
        $order->orderAddress = $orderAddress;
        $order->orderPhone = $orderPhone;
        $order->paymentStatus = $paymentStatus;
        $order->created_at = now('Asia/Ho_Chi_Minh');
        $order->updated_at = now('Asia/Ho_Chi_Minh');
        return $order;
    }
    protected function createOderDetail()
    {
        $list_products = Cart::content();
        $order_list = [];
        foreach ($list_products as $item) {
            $product = Product::find($item->id);
            $product->productInStock = $product->productInStock - $item->qty;
            $product->productSoldQuantity = $product->productSoldQuantity + $item->qty;
            $product->save();
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
        if (!Auth::check()) {
            return redirect()->route('redirectToPayment');
        }
        $info = CustomerInfo::where('userID', Auth::user()->id)->first();
        if ($info->customerPhone == null) {
            $info->customerPhone = '09xxxxxxxx';
        }
        if ($info->customerAddress == null) {
            $info->customerAddress = 'Địa chỉ của bạn';
        }
        if ($info->customerProvinceName == null) {
            $info->customerProvinceName = 'Tỉnh/Thành phố';
        }
        $data = Cart::content();
        return view('user.payment', ['order_list' => $data, 'info' => $info]);
    }
    public function StoreOrder(Request $request)
    {
        $totalPrice = intval($request->input('totalPrice'));
        $paymentMethod = $request->input('paymentMethod');
        $discountValidCode = $request->input('discountValidCode');
        $orderCustomerName = $request->input('orderCustomerName');
        $orderAddress = $request->input('orderAddress');
        $orderPhone = $request->input('orderPhone');
        $paymentStatus = $request->input('paymentStatus');
        $order = $this->createOder($totalPrice, $paymentMethod, $discountValidCode, $orderCustomerName, $orderAddress, $orderPhone, $paymentStatus);
        $order->save();
        $order_list = $this->createOderDetail();
        foreach ($order_list as $item) {
            $item->orderID = $order->orderID;
            $item->save();
        }
        $CustomerInfo = CustomerInfo::where('userID', Auth::user()->id)->first();
        $CustomerInfo->customerOrderQuantity = $CustomerInfo->customerOrderQuantity + 1;
        $CustomerInfo->save();
        Cart::destroy();
        return response()->json(['orderID' => $order->orderID]);
    }

    public function OrderSuccess(Request $request)
    {
        $orderID = $request->orderID;
        $order = Order::find($orderID);
        $order_list = OrderDetail::where('orderID', $orderID)->get();
        orderEmail($orderID);
        return view('user.OrderSuccess', ['order' => $order, 'order_list' => $order_list]);
    }

    public function UpdatePaymentStatusPaid($orderID, $paymentStatus)
    {
        $order = Order::find($orderID);
        $order->paymentStatus = $paymentStatus;
        $order->save();
    }

    public function UpdatePaymentMethod($orderID, $paymentMethod)
    {
        $order = Order::find($orderID);
        $order->paymentMethod = $paymentMethod;
        $order->save();
        return redirect()->route('order.success', ['orderID' => $orderID]);
    }

    public function CancelOrder(Request $request)
    {
        $orderID = $request->orderID;
        $date = now('Asia/Ho_Chi_Minh');
        order::findOrFail($orderID)->update([
            'orderStatus' => 'canceled',
            'orderCompletedDate' => $date,
        ]);


        // update product quantity
        $productlist = OrderDetail::where('orderID', $orderID)->get();
        foreach ($productlist as $orderdetail) {
            $product = Product::find($orderdetail->productID);
            $quantity = $orderdetail->productQuantity;
            $product->productInStock += $quantity;
            $product->productSoldQuantity -= $quantity;
            $product->save();
        }
        return response()->json(['status' => true]);
    }

}
