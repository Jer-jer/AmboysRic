<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\EmployeesController;

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

Route::get('/register', function () {
    return view('register');
});

Auth::routes();

Route::get('', [ProductsController::class, 'index'])->name('inventory');
Route::get('employees', [EmployeesController::class, 'index'])->name('employees');
Route::get('shopping_cart', [ShoppingCartController::class, 'index'])->name('shopping_cart');

//Modals
Route::post('add_product', [ProductsController::class, 'addProduct'])->name('add_product');
Route::get('edit_product', [ProductsController::class, 'showProd'])->name('edit_product');
Route::post('edit_product_confirm', [ProductsController::class, 'updateProduct'])->name('edit_product_confirm');
Route::get('delete_product/{id}', [ProductsController::class, 'deleteProduct'])->name('delete_product/{id}');
Route::get('edit_employee', [EmployeesController::class, 'dataShow'])->name('edit_employee');
Route::get('delete_employee/{id}', [EmployeesController::class, 'deleteEmployee'])->name('delete_employee/{id}');

Route::get('add-to-cart/{id}', [ShoppingCartController::class, 'addToCart'])->name('add-to-cart/{id}');
Route::patch('update-cart', [ShoppingCartController::class, 'update'])->name('update-cart');
Route::get('remove-from-cart/{id}', [ShoppingCartController::class, 'remove'])->name('remove-from-cart/{id}');
Route::get('receipts', [ShoppingCartController::class, 'showReceipt'])->name('receipts');
Route::get('make-purchase', [ShoppingCartController::class, 'makePurchase'])->name('make-purchase');


Route::post('admin_check', [EmployeesController::class, 'adminCheck'])->name('admin_check');
