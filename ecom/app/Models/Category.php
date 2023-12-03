<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'categoryID';
    protected $fillable = [
        'categoryID',
        'categoryName',
        'categorySlug',
        'categoryImage',
        'categoryDescription',
        'subCategoryCount',
        'productCount',
        'categoryCreatedDate',
        'categoryModifiedDate',
        'categoryParentID',
        'isActive',
    ];
}
