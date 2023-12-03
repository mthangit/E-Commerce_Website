<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;    
use Illuminate\Http\Request;         

class SubCategoryController extends Controller
{
    public function Index(Request $request)
    {
        $status = $request->input('status', 'available');

        if ($status === 'available') {
            $subcategories = Subcategory::where('isActive', 1)->latest()->paginate(10);
        } elseif ($status === 'unavailable') {
            $subcategories = Subcategory::where('isActive', 0)->latest()->paginate(10);
        } else {
            $subcategories = Subcategory::latest()->paginate(10);
        }
        return view('admin.allsubcategory', compact('subcategories'));
    }

    public function SearchSubCategory(Request $request)
    {
        $searchQuery = $request->input('q');
        $subcategories = Subcategory::where('subCategoryName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.allsubcategory', compact('subcategories'));
    }
    public function AddSubCategory()
    {   
        $categories = Category::latest()->get();
        return view('admin.addsubcategory',compact('categories'));
    }

    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'subCategoryName' => 'required|unique:subcategories'
        ]);

        
        $category_ID = $request->categoryID;

        $category_Name = Category::where('categoryID',$category_ID)->value('categoryName');
        $isActive = $request->has('isActive') ? 1 : 0;
        Subcategory::insert([
            'subCategoryName' => $request->subCategoryName,
            'subCategorySlug' => strtolower(str_replace(' ', '-', $request->subCategoryName)),
            'subCategoryDescription' => $request->subCategoryDescription,
            'subCategoryCreatedDate' => $request->subCategoryCreatedDate,
            'subCategoryModifiedDate' => $request->subCategoryModifiedDate, // Ban đầu, giả sử ngày tạo và ngày sửa giống nhau
            'categoryID' => $category_ID,
            'categoryName' => $category_Name,
            'isActive' => $isActive,
        ]);

        Category::where('categoryID',$category_ID)->increment('subCategoryCount',1); // Tăng subCategoryCount lên 1 đơn vị sau khi thêm subcategory

        return redirect()->route('allsubcategory')->with('message', 'Thêm danh mục thành công');
    }

    public function EditSubCategory($subCategoryID)
    {   
        $subCategoryInfo = Subcategory::findOrFail($subCategoryID);
        return view('admin.editsubcategory', compact('subCategoryInfo'));
    }
    public function UpdateSubCategory(Request $request)
    {   
        $subCategoryID = $request->subCategoryID;
        $request->validate([
            'subCategoryName' => 'required|unique:subcategories,subcategoryName,' . $subCategoryID . ',subCategoryID'
        ]);

        $subCategoryID = $request->subCategoryID;
        $isActive = $request->has('isActive') ? 1 : 0;
        Subcategory::findOrFail($subCategoryID)->update([
            'subCategoryName' => $request->subCategoryName,
            'subCategorySlug' => strtolower(str_replace(' ', '-', $request->subCategoryName)),
            'subCategoryDescription' => $request->subCategoryDescription,
            'subCategoryCreatedDate' => $request->subCategoryCreatedDate,
            'subCategoryModifiedDate' => $request->subCategoryModifiedDate, // Ban đầu, giả sử ngày tạo và ngày sửa giống nhau
            'isActive' => $isActive,
        ]);

        return redirect()->route('allsubcategory')->with('message', 'Cập nhật danh mục thành công');
    }

    public function DeleteSubCategory($subCategoryID)
    {   
        $categoryID = Subcategory::where('subCategoryID',$subCategoryID)->value('categoryID');

      //  Subcategory::findOrFail($subCategoryID)->delete();
        Subcategory::where('subCategoryID', $subCategoryID)->update(['isActive' => 0]);
        Category::where('categoryID',$categoryID)->decrement('subCategoryCount',1); // Giảm subCategoryCount xuống 1 đơn vị sau khi xóa subcategory
        return redirect()->route('allsubcategory')->with('message', 'Xóa danh mục thành công');
    }
}
