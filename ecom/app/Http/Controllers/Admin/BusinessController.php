<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\CustomerInfo;
use Carbon\Carbon;

class BusinessController extends Controller
{
    public function checkProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $products = Product::latest()->get();

        return view('admin.business', compact('categories', 'subcategories', 'products'));
    }
    public function checkSubcategory()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $products = Product::latest()->get();

        return view('admin.businesssubcategory', compact('categories', 'subcategories', 'products'));
    }

    // Function to fetch subcategories based on the selected category
    public function fetchResults(Request $request)
    {
        // Retrieve form data
        $productCategoryID = $request->input('productCategoryID');
        $productSubCategoryID = $request->input('productSubCategoryID');
        $productID = $request->input('productID');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Add logic to query the database and fetch results based on the provided parameters
        $results = OrderDetail::select('products.productName', 'order_details.created_at', 'order_details.productQuantity', 'order_details.productTotalPrice')
            ->join('products', 'order_details.productID', '=', 'products.productID')
            ->where('products.productCategoryID', $productCategoryID)
            ->where('products.productSubCategoryID', $productSubCategoryID)
            ->where('products.productID', $productID)
            ->where('order_details.orderDetailStatus', '<>', 'canceled') // Exclude 'canceled' status
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('order_details.created_at', '>=', $startDate)
                    ->whereDate('order_details.created_at', '<=', $endDate);
            })
            ->get();

        // Return the results as JSON
        return response()->json($results);
    }

    public function fetchSubcategoryResults(Request $request)
    {
        // Retrieve form data
        $productCategoryID = $request->input('productCategoryID');
        $productSubCategoryID = $request->input('productSubCategoryID');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Add logic to query the database and fetch results based on the provided parameters
        $results = OrderDetail::select('products.productName', 'order_details.created_at', 'order_details.productQuantity', 'order_details.productTotalPrice')
            ->join('products', 'order_details.productID', '=', 'products.productID')
            ->where('products.productCategoryID', $productCategoryID)
            ->where('products.productSubCategoryID', $productSubCategoryID)
            ->where('order_details.orderDetailStatus', '<>', 'canceled') // Exclude 'canceled' status
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('order_details.created_at', '>=', $startDate)
                    ->whereDate('order_details.created_at', '<=', $endDate);
            })
            ->get();

        // Return the results as JSON
        return response()->json($results);
    }


    public function calculateTotalSales()
    {
        // Calculate the total sales value using Eloquent
        $totalSales = Order::where('orderStatus', '<>', 'canceled')->sum('grandPrice');
        $totalOrders = Order::where('orderStatus', '<>', 'canceled')->count();
        $totalCustomers = CustomerInfo::count();

        $currentMonth = Carbon::now()->format('m');
    $previousMonth = Carbon::now()->subMonth()->format('m');

    // Calculate the total sales value for the current month
    $currentMonthSales = Order::whereMonth('created_at', $currentMonth)
        ->where('orderStatus', '<>', 'canceled')
        ->sum('grandPrice');

    // Calculate the total sales value for the previous month
    $previousMonthSales = Order::whereMonth('created_at', $previousMonth)
        ->where('orderStatus', '<>', 'canceled')
        ->sum('grandPrice');

    // Calculate the month-over-month growth percentage
    $growthPercentage = ($currentMonthSales - $previousMonthSales) / ($previousMonthSales ?: 1) * 100;

        return view('admin.dashboard', compact('totalSales', 'totalOrders', 'totalCustomers', 'growthPercentage'));
    }
}
