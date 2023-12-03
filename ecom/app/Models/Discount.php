<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $primaryKey = 'discountID';
    protected $fillable = [
        'discountID',
        'discountCode',
        'discountName',
        'discountDescription',
        'discountQuantity',
        'discountUsed',
        'discountType',
        'discountAmount',
        'isActive',
        'discountStart',
        'discountEnd',
    ];

}
