<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function Index(Request $request)
    {
        $status = $request->input('status', 'available');

        if ($status === 'available') {
            $categories = Category::where('isActive', 1)->latest()->paginate(10);
        } elseif ($status === 'unavailable') {
            $categories = Category::where('isActive', 0)->latest()->paginate(10);
        } else {
            $categories = Category::latest()->paginate(10);
        }

        return view('admin.allcategory', compact('categories')); // Phương thức view trả về view 'admin.allcategory' và truyền dữ liệu vào view thông qua mảng compact
    }
    public function SearchCategory(Request $request)
    {
        $searchQuery = $request->input('q');
        $categories = Category::where('categoryName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.allcategory', compact('categories'));
    }

    public function AddCategory()
    {
        return view('admin.addcategory');
    }
    public function StoreCategory(Request $request)
    {
        //     $request->validate([
        //        'categoryName' => 'required|unique:categories'
        //   ]);
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories'
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;
        Category::insert([
            'categoryName' => $request->categoryName,
            'categorySlug' => strtolower(str_replace(' ', '-', $request->categoryName)),
            'categoryDescription' => $request->categoryDescription,
            'categoryCreatedDate' => $request->categoryCreatedDate,
            'categoryModifiedDate' => $request->categoryModifiedDate, // Ban đầu, giả sử ngày tạo và ngày sửa giống nhau
            'isActive' => $isActive,
        ]);

        return redirect()->route('allcategory')->with('message', 'Thêm danh mục thành công');



        if ($validator->passes()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return response()->json([
                'status' => true,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function EditCategory($categoryID)
    {
        $category_info = Category::findOrFail($categoryID);
        return view('admin.editcategory', compact('category_info'));
    }
    public function UpdateCategory(Request $request)
    {
        $categoryID = $request->categoryID;

        $request->validate([
            'categoryName' => 'required|unique:categories,categoryName,' . $categoryID . ',categoryID'
        ]);

        $isActive = $request->has('isActive') ? 1 : 0;
        Category::findOrFail($categoryID)->update([
            'categoryName' => $request->categoryName,
            'categorySlug' => strtolower(str_replace(' ', '-', $request->categoryName)),
            'categoryDescription' => $request->categoryDescription,
            'categoryCreatedDate' => $request->categoryCreatedDate,
            'categoryModifiedDate' => $request->categoryModifiedDate, // Ban đầu, giả sử ngày tạo và ngày sửa giống nhau
            'isActive' => $isActive,
        ]);

        return redirect()->route('allcategory')->with('message', 'Cập nhật danh mục thành công');
    }

    public function DeleteCategory($categoryID)
    {
        $category = Category::findOrFail($categoryID);
    
        // Thay đổi trạng thái isActive về 0
        $category->update(['isActive' => 0]);
    
        return redirect()->route('allcategory')->with('message', 'Đã thực hiện thành công');;
    }
}
