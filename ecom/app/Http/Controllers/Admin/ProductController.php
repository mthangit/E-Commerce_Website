<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index()
    {

        // $products = Product::latest()->get();
        $products = Product::paginate(20); // 10 sản phẩm mỗi trang
        return view('admin.allproduct', compact('products'));
    }

    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();

        return view('admin.addproduct', compact('categories', 'subcategories'));
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
            'productName' => 'required|unique:products',
            'productBrandName' => 'required',
            'productCategoryID' => 'required',
            'productSubCategoryID' => 'required',
            'productCreatedDate' => 'required',
            'productModifiedDate' => 'required',
            'productOriginalPrice' => 'required',
            'productDiscountPrice' => 'required',
            'productInfo' => 'required',
            'productBarcode' => 'required',
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productInStock' => 'required',
        ]);

        $image = $request->file('productImage');
        $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->productImage->move(public_path('upload'), $imgname);
        $imgurl = 'upload/' . $imgname;

        $category_ID = $request->productCategoryID;
        $category_Name = Category::where('categoryID', $category_ID)->value('categoryName');

        $subcategory_ID = $request->productSubCategoryID;
        $subcategory_Name = Subcategory::where('subCategoryID', $subcategory_ID)->value('subCategoryName');

        $isFlashSale = $request->has('isFlashSale') ? 1 : 0;
        $isActive = $request->has('isActive') ? 1 : 0;

        Product::insert([
            'productName' => $request->productName,
            'productSlug' => strtolower(str_replace(' ', '-', $request->productName)),
            'productBrandName' => $request->productBrandName,
            'productCategoryID' => $category_ID,
            'productCategoryName' => $category_Name,
            'productSubCategoryID' => $subcategory_ID,
            'productSubCategoryName' => $subcategory_Name,
            'productOriginalPrice' => $request->productOriginalPrice,
            'productDiscountPrice' => $request->productDiscountPrice,
            'productInfo' => $request->productInfo,
            'productBarcode' => $request->productBarcode,
            'productImage' => $imgurl,
            'productCreatedDate' => $request->productCreatedDate,
            'productModifiedDate' => $request->productModifiedDate,
            'productInStock' => $request->productInStock,
            'isFlashSale' => $isFlashSale,
            'isActive' => $isActive,
        ]);

        return redirect()->route('allproducts')->with('message', 'Thêm sản phẩm thành công');
    }

    public function EditProduct($productID)
    {
        $product_info = Product::findOrFail($productID);
      //  $products = Product::latest()->get();
        return view('admin.editproduct', compact('product_info'));
    }
    public function UpdateProduct(Request $request)
    {
        $productID = $request->productID;

        $request->validate([
            'productName' => 'required:products,productName,' . $productID . ',productID'
        ]);

        
    

        $category_ID = $request->productCategoryID;
        $category_Name = Category::where('categoryID', $category_ID)->value('categoryName');

        $subcategory_ID = $request->productSubCategoryID;
        $subcategory_Name = Subcategory::where('subCategoryID', $subcategory_ID)->value('subCategoryName');

        $isFlashSale = $request->has('isFlashSale') ? 1 : 0;
        $isActive = $request->has('isActive') ? 1 : 0;


        $product = Product::findOrFail($productID);

    // Check if an image is provided
    // if ($request->hasFile('productImage')) {
        
    
    //     // Tiến hành tải lên ảnh mới
    //     $image = $request->file('productImage');
    //     $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    //     $request->productImage->move(public_path('upload'), $imgname);
    //     $imgurl = 'upload/' . $imgname;
    
    //     // Cập nhật thông tin sản phẩm với ảnh mới
    //     $product->update([
    //         'productImage' => $imgurl,
    //     ]);
    // }

    // Check if the user wants to delete the image
   
    $product->update([
        'productName' => $request->productName,
        'productSlug' => strtolower(str_replace(' ', '-', $request->productName)),
        'productBrandName' => $request->productBrandName,
        'productCategoryID' => $category_ID,
        'productCategoryName' => $category_Name,
        'productSubCategoryID' => $subcategory_ID,
        'productSubCategoryName' => $subcategory_Name,
        'productOriginalPrice' => $request->productOriginalPrice,
        'productDiscountPrice' => $request->productDiscountPrice,
        'productInfo' => $request->productInfo,
        'productBarcode' => $request->productBarcode,
        'productCreatedDate' => $request->productCreatedDate,
        'productModifiedDate' => $request->productModifiedDate,
        'productInStock' => $request->productInStock,
        'isFlashSale' => $isFlashSale,
        'isActive' => $isActive,
    ]);

        return redirect()->route('allproduct')->with('message', 'Cập nhật danh mục thành công');
    }

    public function EditProductImg($productID)
    {
        $product_info = Product::findOrFail($productID);
        return view('admin.editproductimg', compact('product_info'));
    }

    public function UpdateProDuctImg( Request $request){
        $request->validate([  
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productID = $request->productID;
        $image = $request->file('productImage');
        $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->productImage->move(public_path('upload'), $imgname);
        $imgurl = 'upload/' . $imgname;

        Product::findOrFail($productID)->update([
            'productImage' => $imgurl,
        ]);
        return redirect()->route('allproduct')->with('message', 'Cập nhật danh mục thành công');
    }

}
