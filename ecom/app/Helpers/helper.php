<?php

use App\Models\Category;
use App\Models\SubCategory;
use App\Mail\OrderEmail;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomerInfo;
use App\Models\Discount;
use App\Models\Province;
use App\Models\Shipping;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;

function getAllCategory()
{
    return Category::all();
}

//function getSubCategoryByCategoryID($categoryID)
//{
//    return Category::where('categoryID', $categoryID)->first();
//}
function getSubCategoryByProductID($productID)
{
    $product = Product::where('productID', $productID)->first();
    return SubCategory::where('subCategoryID', $product->productSubCategoryID)->first();
}
function getCategoryByProductID($productID)
{
    $product = Product::where('productID', $productID)->first();
    $subCategory = SubCategory::where('subCategoryID', $product->productSubCategoryID)->first();
    return Category::where('categoryID', $subCategory->categoryID)->first();
}
function getCategoryByCategoryID($categoryID)
{
    return Category::where('categoryID', $categoryID)->first();
}
function getCategoryByCategorySlug($categorySlug)
{
    return Category::where('categorySlug', $categorySlug)->first();
}
function getProductsBySubCategoryID($subCategoryID)
{
    //    return Product::where('subCategoryID', $subCategoryID)->get();
    //return product with status active and in stock > 0 and subcategory id
    return Product::where('subCategoryID', $subCategoryID)->where('isActive', 1)->where('productInStock', '>', 0)->paginate(12);
}

function getImageProductByProductID($productID)
{
    return Product::where('productID', $productID)->first();
}
function orderEmail($orderID)
{
    $order = Order::where('orderID', $orderID)->with('items')->first();
    $customerinfo = CustomerInfo::leftJoin('orders', 'orders.customerID', '=', 'customer_infos.customerID')->where('orders.orderID', $orderID)->first();
    $discount = Discount::leftJoin('orders', 'orders.discountID', '=', 'discounts.discountID')->where('orders.orderID', $orderID)->first();
    if ($customerinfo) {
        $mailData = [
            'subject' => 'Cảm ơn đã mua hàng',
            'order' => $order,
            'discount' => $discount,
        ];
        // Make sure the 'customerEmail' property exists in the CustomerInfo model
        if (!empty($customerinfo->customerEmail)) {
            Mail::to($customerinfo->customerEmail)->send(new OrderEmail($mailData));
        } else {
            Log::error('Email address not found for order: ' . $orderID);
        }
    } else {
        Log::error('Customer info not found for order: ' . $orderID);
    }
}
function getProvinceByProvinceID($provinceID)
{
    return Province::where('provinceID', $provinceID)->first();
}
function getProvinceByProvinceName($provinceName)
{
    return Province::where('provinceName', $provinceName)->first()->value('provinceID');
}

function getShippingExpenseByProvinceID($provinceID)
{
    return Shipping::where('provinceID', $provinceID)->value('shippingExpense');
}

function getAllBrand()
{
    return Brand::all();
}
function getBrandByBrandID($brandID)
{
    return Brand::where('brandID', $brandID)->first();
}
