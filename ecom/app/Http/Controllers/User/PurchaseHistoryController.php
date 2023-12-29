<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\PurchaseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PurchaseHistoryController extends Controller
{
    public function storePurchaseHistory($orderID, $totalPrice, $paymentMethod)
    {
        $history = new PurchaseHistory();
        $order = Order::where('orderID', $orderID)->first();
        $history->customerID = $order->customerID;
        $history->orderID = $orderID;
        $history->totalPrice = $totalPrice;
        $history->paymentMethod = $paymentMethod;
        $history->created_at = now('Asia/Ho_Chi_Minh');
        $history->updated_at = now('Asia/Ho_Chi_Minh');
        $history->save();
    }
}
