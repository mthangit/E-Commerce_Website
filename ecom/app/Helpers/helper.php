<?php

use App\Models\Category;
use App\Models\Product;

function getAllCategory()
    {
        return Category::all();
    }

    function getSubCategoryByCategoryID($categoryID)
    {
        return Category::where('categoryID', $categoryID)->first();
    }

    function getCategoryByCategoryID($categoryID)
    {
        return Category::where('categoryID', $categoryID)->first();
    }
function getCategoryByCategorySlug($categorySlug)
{
    return Category::where('categorySlug', $categorySlug)->first();
}
function getProductsBySubCategoryID($subCategoryID)
{
//    return Product::where('subCategoryID', $subCategoryID)->get();
    //return product with status active and in stock > 0 and subcategory id
    return Product::where('subCategoryID', $subCategoryID)->where('isActive', 1)->where('productInStock', '>', 0)->get();
}


