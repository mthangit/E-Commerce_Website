<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;
    protected  $primaryKey = 'customerID';
    protected $fillable = [
        'customerID',
        'userID',
        'customerName',
        'customerPhone',
        'customerEmail',
        'customerProvinceID',
        'customerAddress',
        'customerStatus',
        'customerJoinDate',
        'customerOrderQuantity',
        'customerBankAccount',
        'customerBankName',
    ];
}
