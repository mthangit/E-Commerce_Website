<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function Index(Request $request)
    {
        $status = $request->input('status', 'available');

        if ($status === 'available') {
            $brands = Brand::where('isActive', 1)->latest()->paginate(10);
        } elseif ($status === 'unavailable') {
            $brands = Brand::where('isActive', 0)->latest()->paginate(10);
        } else {
            $brands = Brand::latest()->paginate(10);
        }

        return view('admin.allbrand', compact('brands')); // Phương thức view trả về view 'admin.allbrand' và truyền dữ liệu vào view thông qua mảng compact
    }
    public function SearchBrand(Request $request)
    {
        $searchQuery = $request->input('q');
        $brands = brand::where('brandName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.allbrand', compact('brands'));
    }

    public function AddBrand()
    {
        return view('admin.addbrand');
    }
    public function StoreBrand(Request $request)
    {
        //     $request->validate([
        //        'brandName' => 'required|unique:brands'
        //   ]);
        $validator = Validator::make($request->all(), [
            'brandName' => 'required|unique:brands'
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;
        brand::insert([
            'brandName' => $request->brandName,
         //   'brandSlug' => strtolower(str_replace(' ', '-', $request->brandName)),
            'brandDescription' => $request->brandDescription,
            'isActive' => $isActive,
        ]);

        return redirect()->route('allbrand')->with('message', 'Thêm danh mục thành công');



        if ($validator->passes()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return response()->json([
                'status' => true,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function EditBrand($brandID)
    {
        $brandInfo = brand::findOrFail($brandID);
        return view('admin.editbrand', compact('brandInfo'));
    }
    public function UpdateBrand(Request $request)
    {
        $brandID = $request->brandID;

        $request->validate([
            'brandName' => 'required|unique:brands,brandName,' . $brandID . ',brandID'
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;
        brand::findOrFail($brandID)->update([
            'brandName' => $request->brandName,
         //   'brandSlug' => strtolower(str_replace(' ', '-', $request->brandName)),
            'brandDescription' => $request->brandDescription,
            'isActive' => $isActive,
        ]);

        return redirect()->route('allbrand')->with('message', 'Cập nhật danh mục thành công');
    }

    public function DeleteBrand($brandID)
    {
        $brand = Brand::findOrFail($brandID);
    
        // Thay đổi trạng thái isActive về 0
        $brand->update(['isActive' => 0]);
    
        return redirect()->route('allbrand')->with('message', 'Đã thực hiện thành công');;
    }
}
