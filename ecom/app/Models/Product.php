<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'productID';
    protected $fillable = [
        'productID',
        'productName',
        'productBrandID',
        'productBrandName',
        'productSubCategoryID',
        'productSubCategoryName' ,
	    'productCategoryID' ,
	    'productCategoryName' ,
        'productOriginalPrice',
        'productDiscountPrice',
        'productInfo',
        'productBarcode',
        'productInStock',
        'productImage',
        'productSideImage1',
        'productSideImage2',
        'productSideImage3',
        'productCreatedDate',
        'productModifiedDate',
        'productSlug',
        'isFlashSale',
        'isActive',
    ];
}
