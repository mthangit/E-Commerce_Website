<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Province;

class ShippingController extends Controller
{
    //
    public function Index()
    {
        $provinces = Province::latest()->get();
        // $products = Product::latest()->get();
        $shippings = Shipping::latest()->get(); // 10 sản phẩm mỗi trang
        return view('admin.allshipping', compact('shippings', 'provinces'));
    }

    public function SearchShipping(Request $request)
    {
        $searchQuery = $request->input('q');

        $shippings = Shipping::join('provinces', 'shippings.provinceID', '=', 'provinces.provinceID')
        ->where('provinces.provinceName', 'like', '%' . $searchQuery . '%')
        ->select('shippings.*')  // Select the columns from the shippings table
        ->get();
        $provinces = Province::latest()->get();

        return view('admin.allshipping', compact('shippings','provinces'));
    }


    public function AddShipping()
    {
        $provinces = Province::latest()->get();
        // $products = Product::latest()->get();
        $shippings = Shipping::latest()->get();
        return view('admin.addshipping',compact('provinces'));
    }

    public function StoreShipping(Request $request)
    {
        $request->validate([
            'provinceID' => 'required|unique:shippings'
        ]);

        Shipping::insert([
            'provinceID' => $request->provinceID,
            'shippingExpense' => $request->shippingExpense,
        ]);


        return redirect()->route('allshipping')->with('message', 'Thêm thành công');
    }

    public function UpdateShipping(Request $request)
    {
        $shippingID = $request->shippingID;

        // $request->validate([
        //     'shippingExpense' => 'required|unique:shippings' . $shippingID . ',shippingID'
        // ]);

        shipping::findOrFail($shippingID)->update([
            'shippingExpense' => $request->shippingExpense,
        ]);

        return redirect()->route('allshipping')->with('message', 'Cập nhật thành công');
    }

    public function EditShipping($shippingID)
    {   
        $provinces = Province::latest()->get();
        $shipping_info = shipping::findOrFail($shippingID);
        return view('admin.editshipping', compact('shipping_info','provinces'));
    }

    public function DeleteShipping($shippingID)
    {
        $shipping = shipping::findOrFail($shippingID);

        // Thay đổi trạng thái isActive về 0
        $shipping->update(['isActive' => 0]);

        return redirect()->route('allshipping')->with('message', 'Đã thực hiện thành công');;
    }
}
