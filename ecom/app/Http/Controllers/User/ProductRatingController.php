<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRating;

class ProductRatingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'userName' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'productID' => 'required|exists:products,productID', // Assuming 'products' is your products table
        ]);

        // Extract product ID from the form
        $productId = $request->input('productID');

        // Prepare the data for mass insertion
        $data = [
            'productID' => $productId,
            'userName' => $request->input('userName'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'status' => '0', // You can set a default status if needed
        ];

        // Use the insert method for mass insertion
        ProductRating::insert([$data]);

        // Redirect back or wherever you need to go
        return redirect()->back();
    }
}
