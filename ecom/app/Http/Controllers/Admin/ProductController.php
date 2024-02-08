<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(Request $request)
    {
        $search = $request->get("search");
        $status = $request->input('status', 'available');

        $products = Product::latest();

        if (empty($status)) {
            $products = Product::latest();
        } else {
            if ($status === 'available') {
                $products = Product::where('isActive', 1)->latest();
            } elseif ($status === 'unavailable') {
                $products = Product::where('isActive', 0)->latest();
            } else {
                $products = Product::latest();
            }
        }

        if (!empty($search)) {
            $products = $products->where('productName', 'like', '%' . $search . '%');
        }

        $products = $products->paginate(20);
        // $products = Product::latest()->get();
        ; // 10 sản phẩm mỗi trang
        return view('admin.allproduct', compact('products'));
    }

    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $brands = Brand::latest()->get();

        return view('admin.addproduct', compact('categories', 'subcategories', 'brands'));
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
            'productName' => 'required|unique:products',
            'productBrandID' => 'required',
            'productCategoryID' => 'required',
            'productSubCategoryID' => 'required',
            'productOriginalPrice' => 'required',
            'productDiscountPrice' => 'required',
            'productInfo' => 'required',
            'productBarcode' => 'required',
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productSideImage1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productSideImage2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productSideImage3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productInStock' => 'required'
        ]);

        $image = $request->file('productImage');
        $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->productImage->move(public_path('upload'), $imgname);
        $imgurl = 'upload/' . $imgname;

        $image1 = $request->file('productSideImage1');
        $imgname1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
        $request->productSideImage1->move(public_path('upload'), $imgname1);
        $imgurl1 = 'upload/' . $imgname1;

        $image2 = $request->file('productSideImage2');
        $imgname2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
        $request->productSideImage2->move(public_path('upload'), $imgname2);
        $imgurl2 = 'upload/' . $imgname2;

        $image3 = $request->file('productSideImage3');
        $imgname3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
        $request->productSideImage3->move(public_path('upload'), $imgname3);
        $imgurl3 = 'upload/' . $imgname3;



        $category_ID = $request->productCategoryID;
        $category_Name = Category::where('categoryID', $category_ID)->value('categoryName');

        $subcategory_ID = $request->productSubCategoryID;
        $subcategory_Name = Subcategory::where('subCategoryID', $subcategory_ID)->value('subCategoryName');

        $brand_ID = $request->productBrandID;
        $brand_Name = Brand::where('brandID', $brand_ID)->value('brandName');


        $isActive = $request->has('isActive') ? 1 : 0;

        Product::insert([
            'productName' => $request->productName,
            'productSlug' => strtolower(str_replace(' ', '-', $request->productName)),
            'productBrandID' => $brand_ID,
            'productBrandName' => $brand_Name,
            'productCategoryID' => $category_ID,
            'productCategoryName' => $category_Name,
            'productSubCategoryID' => $subcategory_ID,
            'productSubCategoryName' => $subcategory_Name,
            'productOriginalPrice' => $request->productOriginalPrice,
            'productDiscountPrice' => $request->productDiscountPrice,
            'productInfo' => $request->productInfo,
            'productBarcode' => $request->productBarcode,
            'productImage' => $imgurl,
            'productSideImage1' => $imgurl1,
            'productSideImage2' => $imgurl2,
            'productSideImage3' => $imgurl3,
            'productInStock' => $request->productInStock,
            'productCreatedDate' => now('Asia/Ho_Chi_Minh'), // 'Asia/Ho_Chi_Minh
            'isFlashSale' => 1,
            'isActive' => $isActive,
        ]);

        return redirect()->route('allproduct')->with('message', 'Thêm sản phẩm thành công');
    }

    public function EditProduct($productID)
    {
        $product_info = Product::findOrFail($productID);
        $brands = Brand::latest()->get();
        //  $products = Product::latest()->get();
        return view('admin.editproduct', compact('product_info', 'brands'));
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
            'productBrandID' => $request->productBrandID,
            'productOriginalPrice' => $request->productOriginalPrice,
            'productDiscountPrice' => $request->productDiscountPrice,
            'productInfo' => $request->productInfo,
            'productBarcode' => $request->productBarcode,
            'productModifiedDate' => now('Asia/Ho_Chi_Minh'),
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

    public function UpdateProductImg(Request $request)
    {
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

    public function EditProductSideImgOne($productID)
    {
        $product_info = Product::findOrFail($productID);
        return view('admin.editproductsideimgone', compact('product_info'));
    }

    public function UpdateProductSideImgOne(Request $request)
    {
        $request->validate([
            'productSideImageOne' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productID = $request->productID;
        $image = $request->file('productSideImageOne');
        $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->productSideImageOne->move(public_path('upload'), $imgname);
        $imgurl = 'upload/' . $imgname;

        Product::findOrFail($productID)->update([
            'productSideImage1' => $imgurl,
        ]);
        return redirect()->route('allproduct')->with('message', 'Cập nhật danh mục thành công');
    }

    public function EditProductSideImgTwo($productID)
    {
        $product_info = Product::findOrFail($productID);
        return view('admin.editproductsideimgtwo', compact('product_info'));
    }

    public function UpdateProductSideImgTwo(Request $request)
    {
        $request->validate([
            'productSideImageTwo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productID = $request->productID;
        $image = $request->file('productSideImageTwo');
        $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->productSideImageTwo->move(public_path('upload'), $imgname);
        $imgurl = 'upload/' . $imgname;

        Product::findOrFail($productID)->update([
            'productSideImage2' => $imgurl,
        ]);
        return redirect()->route('allproduct')->with('message', 'Cập nhật danh mục thành công');
    }

    public function EditProductSideImgThree($productID)
    {
        $product_info = Product::findOrFail($productID);
        return view('admin.editproductsideimgthree', compact('product_info'));
    }

    public function UpdateProductSideImgThree(Request $request)
    {
        $request->validate([
            'productSideImageThree' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productID = $request->productID;
        $image = $request->file('productSideImageThree');
        $imgname = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->productSideImageThree->move(public_path('upload'), $imgname);
        $imgurl = 'upload/' . $imgname;

        Product::findOrFail($productID)->update([
            'productSideImage3' => $imgurl,
        ]);
        return redirect()->route('allproduct')->with('message', 'Cập nhật danh mục thành công');
    }

    public function SearchProduct(Request $request)
    {
        $searchQuery = $request->input('q');
        $products = Product::where('productName', 'like', '%' . $searchQuery . '%')->paginate(10);

        return view('admin.allproduct', compact('products'));
    }
    public function DeleteProduct($categoryID)
    {
        $product = Product::findOrFail($categoryID);

        // Thay đổi trạng thái isActive về 0
        $product->update(['isActive' => 0]);

        return redirect()->route('allproduct')->with('message', 'Đã thực hiện thành công');;
    }
}
