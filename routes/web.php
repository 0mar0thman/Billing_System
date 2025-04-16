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
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchiveController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home'); // لو مسجّل دخوله يروح هوم
    }
    return view('auth.login'); // غير كده يروح صفحة تسجيل الدخول
});

Route::post('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();
// Auth::routes(['register' => false]);

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
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);
Route::get('/Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');
Route::get('Invoice_Paid',[InvoicesController::class , 'Invoice_Paid'])->name('Invoice_Paid');
Route::get('Invoice_Partial',[InvoicesController::class , 'Invoice_Partial'])->name('Invoice_Partial');
Route::get('Invoice_UnPaid',[InvoicesController::class , 'Invoice_UnPaid'])->name('Invoice_UnPaid');

Route::get('/invoices/print/{id}', [InvoicesController::class, 'print'])->name('invoices.print');
// ====================
//  الارشيف
// ====================
Route::resource('Archive', InvoiceAchiveController::class);

// ====================
//  الأقسام
// ====================
Route::resource('sections', SectionsController::class);

// ====================
//  المنتجات
// ====================
Route::resource('products', ProductsController::class);

Route::delete('attachments/{id}', [InvoicesDetailsController::class, 'destroy'])->name('attachments.destroy');

// ====================
//  صفحات ديناميكية (لـ SPA أو صفحات تحكم)
// ====================
Route::get('/{page}', [AdminController::class, 'index'])->where('page', '.*');
