<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;
    protected $primaryKey = 'productRatingID';
    protected $fillable = [
        'productRatingID',
        'productID',
        'userName',
        'email',
        'rating',
        'comment',
        'status',
       
    ];
}
