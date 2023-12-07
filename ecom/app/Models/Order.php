<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected  $primaryKey = 'orderID';
    protected $fillable = [
        'orderID',
        'customerID',
        'totalPrice',
        'shippingFee',
        'discountID',
        'discountCode',
        'discountPrice',
        'grandPrice',
        'paymentMethod',
        'orderCreatedDate',
        'orderCompletedDate',
        'orderAddress',
        'orderPhone',
        'paymentStatus',
        'orderStatus',
    ];
}
