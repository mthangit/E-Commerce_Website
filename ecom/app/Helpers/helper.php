<?php

use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use App\Mail\OrderEmail;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
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
    $orderDetails = OrderDetail::where('orderID', $orderID)->get();
    $customerInfo = CustomerInfo::where('customerID', $order->customerID)->first();
    
    $mailData = [
        'subject' => 'PING Shop đã tiếp nhận đơn hàng ' . $orderID . ' của bạn',
        'order' => $order,
        'orderDetails' => $orderDetails,
        'customerInfo' => $customerInfo,
    ];

    Mail::to($customerInfo->customerEmail)->send(new OrderEmail($mailData));

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
if (!function_exists('formatCurrency')) {
    function formatCurrency($amount): string
    {
        return number_format($amount, 0, ',', '.');
    }
}

function get4blog(){
    return Blog::get()->take(4);
}
