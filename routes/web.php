<?php

use App\Livewire\BillingDetails;
use App\Livewire\Cart;
use App\Livewire\Home;
use App\Livewire\Products\CategoryProductsList;
use App\Livewire\Products\ProductDetails;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Home::class)->name('home');
Route::get('/c/{category_id}/{category_slug}', CategoryProductsList::class)
	->name('category_products');
Route::get('/{id}/{slug}', ProductDetails::class)
	->name('product_details');
Route::get('/cart', Cart::class)
	->name('cart');
Route::get('/billing-details', BillingDetails::class)
	->name('billing_details');
