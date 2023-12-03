<?php

namespace App\Http\Controllers\Admin;
use App\Models\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function Index(Request $request)
    {

        $status = $request->input('status', 'available');

        if ($status === 'available') {
            $discounts = discount::where('isActive', 1)->latest()->paginate(10);
        } elseif ($status === 'unavailable') {
            $discounts = discount::where('isActive', 0)->latest()->paginate(10);
        } else {
            $discounts = discount::latest()->paginate(10);
        }

        return view('admin.alldiscount', compact('discounts')); // Phương thức view trả về view 'admin.alldiscount' và truyền dữ liệu vào view thông qua mảng compact
    }

    public function SearchDiscount(Request $request)
    {
        $searchQuery = $request->input('q');
        $discounts = Discount::where('discountName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.alldiscount', compact('discounts'));
    }


    public function AddDiscount()
    {
        return view('admin.adddiscount');
    }

    public function StoreDiscount(Request $request)
    {
        $request->validate([
            'discountName' => 'required|unique:discounts',
           // 'discountCode' => 'required|unique:discounts',
         
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;

        discount::insert([
            'discountName' => $request->discountName,
            'discountCode' => $request->discountCode,
            'discountDescription' => $request->discountDescription,
            'discountType' => $request->discountType,
            'discountAmount' => $request->discountAmount,
            'discountQuantity' => $request->discountQuantity,
            'isActive' => $isActive,
        ]);

        return redirect()->route('alldiscount')->with('message', 'Thêm sản phẩm thành công');
    }

    public function UpdateDiscount(Request $request)
    {
        $discountID = $request->discountID;

        $request->validate([
            'discountName' => 'required|unique:discounts,discountName,' . $discountID . ',discountID'
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;
        discount::findOrFail($discountID)->update([
            'discountName' => $request->discountName,
            'discountCode' => $request->discountCode,
            'discountDescription' => $request->discountDescription,
            'discountType' => $request->discountType,
            'discountAmount' => $request->discountAmount,
            'discountQuantity' => $request->discountQuantity,
            'isActive' => $isActive,
        ]);

        return redirect()->route('alldiscount')->with('message', 'Cập nhật thành công');
    }

    public function EditDiscount($discountID)
    {
        $discount_info = Discount::findOrFail($discountID);
        return view('admin.editdiscount', compact('discount_info'));
    }

    public function DeleteDiscount($discountID)
    {
        $discount = discount::findOrFail($discountID);
    
        // Thay đổi trạng thái isActive về 0
        $discount->update(['isActive' => 0]);
    
        return redirect()->route('alldiscount')->with('message', 'Đã thực hiện thành công');;
    }
}
