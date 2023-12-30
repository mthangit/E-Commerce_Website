<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Iluminate\Http\Request;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\SubCategoryController as UserSubCategoryController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\DiscountController as UserDiscountController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\AccountController as UserAccountController;
use App\Http\Controllers\User\ProductRatingController  as UserProductRatingController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\BlogController as UserBlogController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/thankyou-email', function () {
});

Route::get('/', function () {
    return view('user.dashboard_user');
});


Route::get('/userprofile', [DashboardController::class, 'Index']);

/////////////////////////
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::controller(UserDashboardController::class)->group(function () {
    Route::get('/user/dashboard', 'Index')->name('userdashboard');
    Route::get('/about', 'About')->name('about');
    Route::get('/most-asked-questions', 'MostAsked')->name('mostasked');
    Route::get('/privacy-policy', 'PrivacyPolicy')->name('privacypolicy');
    Route::get('/terms-of-use', 'TermOfUse')->name('termofuse');
    Route::get('/contact', 'Contact')->name('contact');
    Route::get('/delivery-policy', 'DeliveryPolicy')->name('deliverypolicy');
    Route::get('/return-policy', 'ReturnPolicy')->name('returnpolicy');
    Route::get('/blog', 'Blog')->name('blog');
});

Route::controller(UserBlogController::class)->group(function () {
    Route::get('/blog-detail/{blogSlug}', 'BlogDetail')->name('blog.detail');
});

Route::controller(UserCategoryController::class)->group(function () {
    Route::get('/product-list/{categorySlug}', 'Index')->name('product list with category');
});

Route::controller(UserSubCategoryController::class)->group(function () {
    Route::get('/product-list/{categorySlug}/{subCategorySlug}', 'Index')->name('productlist');
});

Route::controller(UserProductController::class)->group(function () {
    Route::get('/product-list/{categorySlug}/{subCategorySlug?}/sanpham/{productSlug}', 'ProductDetail')->name('detail product');
    Route::get('/search/result', 'ProductListByKeyword')->name('search product');
    Route::post('/sortProducts', 'SortProducts')->name('sort products');
});

Route::controller(UserProductRatingController::class)->group(function () {
    Route::post('/storerating', 'store')->name('storerating');
});


Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'Index')->name('cart');
    Route::post('add-to-cart', 'AddToCart')->name('add to cart');
    Route::post('/cart/delete', 'DeleteCart')->name('delete.cart');
    Route::post('/cart/update', 'UpdateCart')->name('update cart');
});

Route::controller(UserAccountController::class)->group(function () {
    Route::get('/user/detail-account', 'DetailAccount')->name('detailuseraccount');
    Route::get('/user/detail-order/{orderID}', 'DetailOrder')->name('detailuserorder');
    Route::post('/user/update-account', 'UpdateAccount')->name('updateaccount');
    Route::post('/update-address', 'UpdateAddress');
});

Route::controller(UserOrderController::class)->group(function () {
    Route::get('/payment', 'Index')->name('payment');
    Route::post('store-order', 'StoreOrder')->name('store.order');
    Route::get('/order-success/{orderID}', 'OrderSuccess')->name('order.success');
    Route::post('cancel-order', 'CancelOrder')->name('cancel order');
});

Route::controller(UserDiscountController::class)->group(function () {
    Route::post('/validate-discount-code', 'ValidateDiscountCode')->name('validate discount code');
});

Route::controller(PaymentController::class)->group(function () {
    Route::post('/vnpay-payment', 'vnpay_payment')->name('vnpay.payment');
    Route::get('/vnpay-return', 'VnpayReturn')->name('vnpay.return');
    Route::get('/vnpay-error', 'VnpayError')->name('vnpay error');
    Route::post('/momo-payment', 'momo_payment')->name('momo.payment');
    Route::get('/momo-redirect', 'redirectMomoPayment')->name('momo.redirect');
});

Route::get('/user-profile', [DashboardController::class, 'Index']);
Route::get('/product-detail', [ProductController::class, 'Index'])->name('productdetail');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(\App\Http\Controllers\User\DashboardController::class)->group(function () {
        Route::get('/user/dashboard', 'Index')->name('userdashboard');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'DashboardAdmin')->name('admindashboard');
        Route::get('/admin/shop-dashboard', 'ShopDashboard')->name('adminshopdashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all-category', 'Index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
        Route::post('/admin/store-category', 'StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{categoryID}', 'EditCategory')->name('editcategory');
        Route::post('/admin/update-category', 'UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{categoryID}', 'DeleteCategory')->name('deletecategory');
        Route::get('/admin/search-category', 'SearchCategory')->name('searchcategory');
    });


    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/all-subcategory', 'Index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{subCategoryID}', 'EditSubCategory')->name('editsubcategory');
        Route::post('/admin/update-subcategory', 'UpdateSubCategory')->name('updatesubcategory');
        Route::get('/admin/delete-subcategory/{subcategoryID}', 'DeleteSubCategory')->name('deletesubcategory');
        Route::get('/admin/search-subcategory', 'SearchSubCategory')->name('searchsubcategory');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/all-product', 'Index')->name('allproduct');
        Route::get('/admin/add-product', 'AddProduct')->name('addproduct');
        Route::post('/admin/store-product', 'StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product/{productID}', 'EditProduct')->name('editproduct');
        Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{productID}', 'DeleteProduct')->name('deleteproduct');
        Route::get('/admin/search-product', 'SearchProduct')->name('searchproduct');

        Route::post('/admin/update-product-img', 'UpdateProductImg')->name('updateproductimg');
        Route::get('/admin/edit-product-img/{productID}', 'EditProductImg')->name('editproductimg');

        Route::post('/admin/update-product-side-img-one', 'UpdateProductSideImgOne')->name('updateproductsideimgone');
        Route::get('/admin/edit-product-side-img-one/{productID}', 'EditProductSideImgOne')->name('editproductsideimgone');

        Route::post('/admin/update-product-side-img-two', 'UpdateProductSideImgTwo')->name('updateproductsideimgtwo');
        Route::get('/admin/edit-product-side-img-two/{productID}', 'EditProductSideImgTwo')->name('editproductsideimgtwo');

        Route::post('/admin/update-product-side-img-three', 'UpdateProductSideImgThree')->name('updateproductsideimgthree');
        Route::get('/admin/edit-product-side-img-three/{productID}', 'EditProductSideImgThree')->name('editproductsideimgthree');
    });

    Route::controller(DiscountController::class)->group(function () {
        Route::get('/admin/all-discount', 'Index')->name('alldiscount');
        Route::get('/admin/add-discount', 'AddDiscount')->name('adddiscount');
        Route::post('/admin/store-discount', 'StoreDiscount')->name('storediscount');
        Route::get('/admin/edit-discount/{discountID}', 'EditDiscount')->name('editdiscount');
        Route::get('/admin/delete-discount/{discountID}', 'DeleteDiscount')->name('deletediscount');
        Route::get('/admin/search-discount', 'SearchDiscount')->name('searchdiscount');
        Route::post('/admin/update-discount', 'UpdateDiscount')->name('updatediscount');
    });

    Route::controller(ShippingController::class)->group(function () {
        Route::get('/admin/all-shipping', 'Index')->name('allshipping');
        Route::get('/admin/add-shipping', 'AddShipping')->name('addshipping');
        Route::post('/admin/store-shipping', 'StoreShipping')->name('storeshipping');
        Route::get('/admin/edit-shipping/{shippingID}', 'EditShipping')->name('editshipping');
        Route::get('/admin/delete-shipping/{shippingID}', 'DeleteShipping')->name('deleteshipping');
        Route::get('/admin/search-shipping', 'SearchShipping')->name('searchshipping');
        Route::post('/admin/update-shipping', 'UpdateShipping')->name('updateshipping');
    });

    Route::controller(BrandController::class)->group(function () {
        Route::get('/admin/all-brand', 'Index')->name('allbrand');
        Route::get('/admin/add-brand', 'AddBrand')->name('addbrand');
        Route::post('/admin/store-brand', 'StoreBrand')->name('storebrand');
        Route::get('/admin/edit-brand/{brandID}', 'EditBrand')->name('editbrand');
        Route::get('/admin/delete-brand/{brandID}', 'DeleteBrand')->name('deletebrand');
        Route::get('/admin/search-brand', 'SearchBrand')->name('searchbrand');
        Route::post('/admin/update-brand', 'UpdateBrand')->name('updatebrand');
    });


    Route::controller(BlogController::class)->group(function () {
        Route::get('/admin/all-blog', 'Index')->name('allblog');
        Route::get('/admin/add-blog', 'AddBlog')->name('addblog');
        Route::post('/admin/store-blog', 'StoreBlog')->name('storeblog');
        Route::get('/admin/edit-blog/{blogID}', 'EditBlog')->name('editblog');
        Route::get('/admin/delete-blog/{blogID}', 'DeleteBlog')->name('deleteblog');
        Route::get('/admin/search-blog', 'SearchBlog')->name('searchblog');
        Route::post('/admin/update-blog', 'UpdateBlog')->name('updateblog');
        Route::post('/admin/update-blog-img', 'UpdateBlogImg')->name('updateblogimg');
        Route::get('/admin/edit-blog-img/{blogID}', 'EditBlogImg')->name('editblogimg');
    });


    Route::controller(AccountController::class)->group(function () {
        Route::get('/admin/all-account', 'Index')->name('allaccount');
        Route::get('/admin/detail-account/{customerID}', 'DetailAccount')->name('detailaccount');
    });



    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/all-order', 'Index')->name('allorder');
        Route::get('/admin/detail-order/{orderID}', 'DetailOrder')->name('detailorder');
        Route::post('/admin/update-order-status', 'UpdateOrderStatus')->name('updateorderstatus');
        Route::get('/admin/search-order', 'SearchOrder')->name('searchorder');
    });

    Route::controller(BusinessController::class)->group(function () {
        Route::get('/check-product', [BusinessController::class, 'checkProduct'])->name('checkProduct');
        Route::get('/check-subcategory', [BusinessController::class, 'checkSubcategory'])->name('checkSubcategory');
        Route::post('/fetch-subcategories', [BusinessController::class, 'fetchSubcategories'])->name('fetchSubcategories');
        Route::post('/fetch-products', [BusinessController::class, 'fetchProducts'])->name('fetchProducts');
        Route::post('/business-summary', [BusinessController::class, 'BusinessSummary'])->name('businesssummary');
        Route::post('/fetch-results', [BusinessController::class, 'fetchResults'])->name('fetchResults');
        Route::post('/fetch-sub-results', [BusinessController::class, 'fetchSubcategoryResults'])->name('fetchSubcategoryResults');
        Route::get('/admin/dashboard', [BusinessController::class, 'calculateTotalSales'])->name('admindashboard');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
