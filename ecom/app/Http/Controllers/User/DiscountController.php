<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function ValidateDiscountCode(Request $request)
    {
        $discountCode = $request->input('discountCode');

        // Find the discount with the given code
        $discount = Discount::where('discountCode', $discountCode)->where('isActive', 1)->where('discountQuantity', '>', 0)->first();

        if ($discount) {
            // If the discount exists, return its details
            return response()->json([
                'isValid' => true,
                'discount' => $discount
            ]);
        } else {
            // If the discount does not exist, return isValid as false
            return response()->json([
                'isValid' => false
            ]);
        }
    }
}

