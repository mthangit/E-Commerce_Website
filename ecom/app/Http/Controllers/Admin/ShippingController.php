<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    //
    public function Index()
    {

        // $products = Product::latest()->get();
        $shippings = Shipping::latest()->get(); // 10 sản phẩm mỗi trang
        return view('admin.allshipping', compact('shippings'));
    }

    public function SearchShipping(Request $request)
    {
        $searchQuery = $request->input('q');
        $shippings = shipping::where('shippingName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.allshipping', compact('shippings'));
    }


    public function AddShipping()
    {
        return view('admin.addshipping');
    }

    public function StoreShipping(Request $request)
    {
        $request->validate([
            'shippingName' => 'required|unique:shippings',
           // 'shippingCode' => 'required|unique:shippings',
         
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;

        shipping::insert([
            'shippingName' => $request->shippingName,
            'shippingCode' => $request->shippingCode,
            'shippingDescription' => $request->shippingDescription,
            'shippingType' => $request->shippingType,
            'shippingAmount' => $request->shippingAmount,
            'shippingQuantity' => $request->shippingQuantity,
            'isActive' => $isActive,
        ]);

        return redirect()->route('allshipping')->with('message', 'Thêm sản phẩm thành công');
    }

    public function UpdateShipping(Request $request)
    {
        $shippingID = $request->shippingID;

        $request->validate([
            'shippingName' => 'required|unique:shippings,shippingName,' . $shippingID . ',shippingID'
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;
        shipping::findOrFail($shippingID)->update([
            'shippingName' => $request->shippingName,
            'shippingCode' => $request->shippingCode,
            'shippingDescription' => $request->shippingDescription,
            'shippingType' => $request->shippingType,
            'shippingAmount' => $request->shippingAmount,
            'shippingQuantity' => $request->shippingQuantity,
            'isActive' => $isActive,
        ]);

        return redirect()->route('allshipping')->with('message', 'Cập nhật thành công');
    }

    public function EditShipping($shippingID)
    {
        $shipping_info = shipping::findOrFail($shippingID);
        return view('admin.editshipping', compact('shipping_info'));
    }

    public function DeleteShipping($shippingID)
    {
        $shipping = shipping::findOrFail($shippingID);
    
        // Thay đổi trạng thái isActive về 0
        $shipping->update(['isActive' => 0]);
    
        return redirect()->route('allshipping')->with('message', 'Đã thực hiện thành công');;
    }
}
