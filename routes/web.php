<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailsendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// SEO Redirect: Old URL to New Author-Optimized URL
Route::redirect(
    '/shop/professional-nursing-concepts-challenges-9th-edition-test-bank', 
    '/study/beth-perry-black-professional-nursing-concepts-challenges-9th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-pharmacology-and-the-nursing-process-10th-edition', 
    '/study/linda-lane-lilley-pharmacology-and-the-nursing-process-10th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/advanced-practice-nursing-in-the-care-of-older-adults-3rd-edition-test-bank', 
    '/study/kennedy-malone-advanced-practice-nursing-in-the-care-of-older-adults-3rd-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-leading-and-managing-in-nursing-7th-edition', 
    '/study/yoder-wise-leading-and-managing-in-nursing-7th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/introduction-to-critical-care-nursing-8th-edition-test-bank', 
    '/study/mary-lou-sole-introduction-to-critical-care-nursing-8th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-williams-basic-nutrition-and-diet-therapy-16th-edition', 
    '/study/staci-nix-mcintosh-williams-basic-nutrition-and-diet-therapy-16th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/foundations-of-maternal-newborn-women-s-health-nursing-7th-edition-test-bank', 
    '/study/murray-foundations-of-maternal-newborn-womens-health-nursing-7th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-pathophysiology-9th-edition-mccance', 
    '/study/mccance-huether-pathophysiology-9th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/leddy-pepper-s-professional-nursing-10th-edition-test-bank', 
    '/study/lucy-hood-leddy-peppers-professional-nursing-10th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/interpersonal-relationships-professional-communication-skills-for-nurses-test-bank-9th-edition', 
    '/study/kathleen-underman-boggs-interpersonal-relationships-9th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-understanding-pharmacology-essentials-for-medication-safety', 
    '/study/lilley-understanding-pharmacology-essentials-for-medication-safety-3rd-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-lehne-s-pharmacology-for-nursing-care-11th-edition', 
    '/study/lehnes-pharmacology-for-nursing-care-11th-edition-burchum-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-for-gould-s-pathophysiology-7th-edition', 
    '/study/vanmeter-goulds-pathophysiology-for-the-health-professions-7th-edition-test-bank', 
    301
);
Route::redirect(
    '/shop/test-bank-lewis-medical-surgical-12th-edition', 
    '/study/harding-lewis-medical-surgical-nursing-12th-edition-test-bank', 
    301
);






// 2. Global Migration: Catch-all for all other products
Route::get('/shop/{slug}', function ($slug) {
    return redirect()->to('/study/' . $slug, 301);
})->where('slug', '.*');


// Route::redirect(

//     '/shop/maternal-child-nursing-care-7th-edition-by-shannon-e-perry-marilyn-j-hockenberry-mary-catherine-cashion-4', 
//     '/shop/beth-perry-black-professional-nursing-concepts-challenges-9th-edition-test-bank', 
//     301
// );



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homeprofile');
//Temporal route
// Route::get('/home', [App\Http\Controllers\ShopController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/study/{product}', [App\Http\Controllers\ShopController::class, 'show'])->name('showpage');
Route::get('/preview/{product}', [App\Http\Controllers\ShopController::class, 'preview']);
Route::get('/addcart/{id}', [App\Http\Controllers\ShopController::class, 'addcart']);
Route::get('/removecart/{id}', [App\Http\Controllers\ShopController::class, 'removecart']);
Route::get('/cart', [App\Http\Controllers\ShopController::class, 'cart'])->name('cart');
Route::get('/about', [App\Http\Controllers\ShopController::class, 'about'])->name('about');
Route::get('products/search', [App\Http\Controllers\ShopController::class, 'search'])->name('Booksearch');
Route::get('/search/{book}', [App\Http\Controllers\ShopController::class, 'search'])->name('search');



//Route::get('/products', 'ProductController@create')->name('createproduct');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product_create');
Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('productEdit');
Route::patch('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('productUpdate');

Route::get('/checkout', [App\Http\Controllers\BillingController::class, 'checkout']);
Route::post('/billing/store', [App\Http\Controllers\BillingController::class, 'store']);
Route::get('/billing/retryPayment', [App\Http\Controllers\BillingController::class, 'retryPayment']);

Route::post('/payment/gateway', [PaymentController::class, 'paymentgateway'])->name('gateway');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('success');
Route::get('/payment/fail', [PaymentController::class, 'fail'])->name('fail');
Route::get('/payment/status', [PaymentController::class, 'status'])->name('status');

Route::get('/file/download/{orderRef}/{id}/{slug}', [FileController::class, 'download'])->name('download');
Route::get('/sendmail/newpurchase',[MailsendController::class,'newpurchase'])->name('mail_newpurchase');

Route::get('/transactions', [App\Http\Controllers\BillingController::class, 'transactions'])->name('transactions');
Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');


