<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceDetailsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::resource('category', CategoryController::class);
    
    Route::post('search', [ProductController::class, 'search'])->name('search');
    Route::post('ProductByCategory', [ProductController::class, 'getProductByCategory'])->name('getProductByCategory');
    Route::resource('product', ProductController::class);

    Route::post('invoices/add/{product}', [InvoiceController::class, 'StoreInvoice_InSession'])->name('invoices.session');
    Route::get('invoices/view', [InvoiceController::class, 'viewInvoice'])->name('invoices.view');
    Route::put('update/{product}', [InvoiceController::class, 'updateInvoice_FromSession'])->name('invoices.edite');
    Route::delete('invoices/delete/{product}', [InvoiceController::class, 'deleteInvoice_FromSession'])->name('invoices.delete');
    Route::resource('invoices', InvoiceController::class);

    Route::put('invoiceDetails/{invoiceDetails}', [InvoiceDetailsController::class, 'update'])->name('invoiceDetails.update');
});

Route::prefix('user')->middleware('auth')->group(function(){
    // Route::resource('category', CategoryController::class);
});

Route::get('home', [HomeController::class, 'index'])->name('home');
