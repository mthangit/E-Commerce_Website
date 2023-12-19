<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerInfo;
use App\Models\PurchaseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseHistoryController extends Controller
{
    public function storePurchaseHistory($orderID, $totalPrice, $paymentMethod){
        $history = new PurchaseHistory();
        $history->customerID = CustomerInfo::where('userID', Auth::user()->id)->first()->customerID;
        $history->orderID = $orderID;
        $history->totalPrice = $totalPrice;
        $history->paymentMethod = $paymentMethod;
        $history->save();
    }
}
