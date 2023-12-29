<?php

namespace App\Providers;

// using functions from helper.php
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $categories = \App\Models\Category::all();

        view()->share('categories', $categories);
        $subcategories = \App\Models\Subcategory::all();

        $subcategories_5 = \App\Models\Subcategory::take(5)->get();
        view()->share('subcategories_5', $subcategories_5);
        view()->share('subcategories', $subcategories);
        $products = \App\Models\Product::all();
        view()->share('products', $products);
        $brands = \App\Models\Brand::all();
        view()->share('brands', $brands);


        $flashSaleProducts = Product::where('isActive', 1)->where('productInStock', '>', 0)->orderByRaw('productDiscountPrice / productOriginalPrice')->take(5)->get();;
        view()->share('flashSaleProducts', $flashSaleProducts);

        // get all products from low to high price
        $suggestedProducts = Product::where('isActive', 1)->where('productInStock', '>', 0)->orderBy('productDiscountPrice', 'asc')->take(15)->get();
        view()->share('suggestedProducts', $suggestedProducts);

        $blogs = get4blog();
        view()->share('blogs', $blogs);

        $allblogs = Blog::all();
        view()->share('allblogs', $allblogs);

    }
}
