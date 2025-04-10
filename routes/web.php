<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesSittingsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

//  صفحة البداية: تسجيل الدخول
Route::get('/', function () {
    return view('auth.login');
});

//  تفعيل الراوتات الافتراضية لتسجيل الدخول/الخروج
Auth::routes();
// Auth::routes(['register' => false]);
//  الصفحة الرئيسية بعد تسجيل الدخول
Route::post('/home', [HomeController::class, 'index'])->name('home');


// ====================
//  إعدادات الفواتير
// ====================
Route::prefix('invoices/sitting')->group(function () {
    Route::get('/', [InvoicesSittingsController::class, 'index'])->name('invoices.sitting');
    Route::get('/store', [InvoicesSittingsController::class, 'store'])->name('invoices_sittings.store');
});

// ====================
//  الفواتير
// ====================
Route::get('/invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
Route::get('/section/{id}', [InvoicesController::class, 'getproducts']); // لجلب المنتجات حسب القسم
Route::resource('invoices', InvoicesController::class);

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
// ====================
//  الأقسام
// ====================
Route::resource('sections', SectionsController::class);

// ====================
//  المنتجات
// ====================
Route::resource('products', ProductsController::class);
// Route::post('download/{invoice_number}/{file_name}',InvoicesDetailsController::class , 'open_file');
// Route::post('View_file/{invoice_number}/{file_name}','InvoicesDetailsController@open_file');
Route::delete('attachments/{id}', [InvoicesDetailsController::class, 'destroy'])->name('attachments.destroy');

// ====================
//  صفحات ديناميكية (لـ SPA أو صفحات تحكم)
// ====================
Route::get('/{page}', [AdminController::class, 'index'])->where('page', '.*');
