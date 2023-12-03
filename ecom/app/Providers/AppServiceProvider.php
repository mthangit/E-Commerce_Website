<?php

namespace App\Providers;

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
        view()->share('subcategories', $subcategories);
        $products = \App\Models\Product::all();
        view()->share('products', $products);
    }
}
