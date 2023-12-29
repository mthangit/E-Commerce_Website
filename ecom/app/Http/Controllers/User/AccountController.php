<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Discount;


use App\Models\CustomerInfo;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function Index()
    {
        $customers = CustomerInfo::latest()->get();
        $customerss = CustomerInfo::latest()->get();
        return view('admin.allaccount', compact('customers', 'customerss'));
    }
    public function SearchAccount(Request $request)
    {
        $searchQuery = $request->input('q');
        $customers = CustomerInfo::where('customerName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.allaccount', compact('customers'));
    }
    public function AddAccount()
    {
        return view('admin.addaccount');
    }
    public function StoreAccount(Request $request)
    {
        CustomerInfo::insert([
            'customerName' => $request->customerName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'customerPassword' => $request->customerPassword,
            'customerRole' => $request->customerRole,
            'customerStatus' => $request->customerStatus,
        ]);

        return redirect()->route('allaccount')->with('message', 'Thêm tài khoản thành công');
    }
    public function DetailAccount()
    {
        $userID = Auth()->user()->id;
        $customerID = CustomerInfo::where('userID', $userID)->first()->customerID;
        $customers = CustomerInfo::find($customerID);
        // $orders = Order::leftJoin('customer_infos', 'orders.customerID', '=', 'customer_infos.customerID')->where('orders.customerID', $customerID)->get();
        // orders desc
        $orders = Order::leftJoin('customer_infos', 'orders.customerID', '=', 'customer_infos.customerID')->where('orders.customerID', $customerID)->orderBy('orders.orderID', 'desc')->get();

        return view('user.detailaccount', compact('customers', 'orders'));
    }
    public function UpdateAccount(Request $request)
    {
        $customerID = $request->customerID;
        $userID = $request->userID;

        // stil update if some of the fields are empty


        CustomerInfo::FindorFail($customerID)->update([
            'customerName' => $request->customerName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            //    'customerAddress' => $request->customerAddress,
            'customerBirthDay' => $request->customerBirthDay,
            'customerBankAccount' => $request->customerBankAccount,
            'customerBankName' => $request->customerBankName,
            // 'customerPassword' => $request->customerPassword,
            //  'customerRole' => $request->customerRole,
            //  'customerStatus' => $request->customerStatus,
        ]);

        return redirect()->route('detailuseraccount', $userID)->with('message', 'Cập nhật tài khoản thành công');
    }
    public function UpdateAddress(Request $request)
    {
        $customerID = $request->input('customerID');
        $newAddress = $request->input('newAddress');
        $userID = $request->input('userID');

        // Perform database update logic here
        // Example using Eloquent:
        CustomerInfo::where('customerID', $customerID)->update(['customerAddress' => $newAddress]);


        return redirect()->route('detailuseraccount')->with('message', 'Cập nhật tài khoản thành công');

    }
    public function DeleteAccount($customerID)
    {
        CustomerInfo::find($customerID)->delete();
        return redirect()->route('allaccount')->with('message', 'Xóa tài khoản thành công');
    }

    public function DetailOrder($orderID)
    {
        // $products = Product::latest()->get();
        $order = Order::where('orderID', $orderID)->first(); // 10
        $orderdetails = OrderDetail::where('orderID', $orderID)->get(); // 10
        $customerinfo = CustomerInfo::leftJoin('orders', 'orders.customerID', '=', 'customer_infos.customerID')->where('orders.orderID', $orderID)->first();

        if ($order->discountID == null) {
            $discount = 0;
        } else {
            $discount = Discount::where('discountID', $order->discountID)->first();
        }
        $discount = Discount::leftJoin('orders', 'orders.discountID', '=', 'discounts.discountID')->where('orders.orderID', $orderID)->first();
        return view('user.detailuserorder', compact('order', 'customerinfo', 'orderdetails', 'discount'));
    }
}
