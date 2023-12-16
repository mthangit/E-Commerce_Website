<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
    public function DetailAccount($customerID)
    {
        $customers = CustomerInfo::find($customerID);
        $orders = Order::leftJoin('customer_infos', 'orders.customerID', '=', 'customer_infos.customerID')->where('orders.customerID', $customerID)->get();
        return view('admin.detailaccount', compact('customers', 'orders'));
    }
    public function UpdateAccount(Request $request, $customerID)
    {
        CustomerInfo::find($customerID)->update([
            'customerName' => $request->customerName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'customerPassword' => $request->customerPassword,
            'customerRole' => $request->customerRole,
            'customerStatus' => $request->customerStatus,
        ]);

        return redirect()->route('allaccount')->with('message', 'Cập nhật tài khoản thành công');
    }
    public function DeleteAccount($customerID)
    {
        CustomerInfo::find($customerID)->delete();
        return redirect()->route('allaccount')->with('message', 'Xóa tài khoản thành công');
    }
}
