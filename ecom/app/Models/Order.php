<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;
    protected  $primaryKey = 'orderID';
    protected $fillable = [
        'orderID',
        'customerID',
        'orderCustomerName',
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

    public function items(){
        return $this->hasMany(OrderDetail::class, 'orderID', 'orderID');
    }


}
