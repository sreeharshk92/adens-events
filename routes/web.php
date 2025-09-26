<?php


use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    // Route::get('quotations/{quotation}/pdf-link', [QuotationController::class, 'generatePdfLink'])->name('quotations.pdf-link');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Menu Categories
    Route::resource('menu-categories', MenuCategoryController::class)->except(['show']);
    
    // Menu Items
    Route::resource('menu-items', MenuItemController::class)->except(['show']);
    
    // Quotations
    Route::resource('quotations', QuotationController::class);
Route::get('quotations/{quotation}/download-pdf', [QuotationController::class, 'downloadPdf'])->name('quotations.download-pdf');
Route::get('quotations/{quotation}/view-pdf', [QuotationController::class, 'viewPdf'])->name('quotations.view-pdf');
Route::get('quotations/{quotation}/share-whatsapp', [QuotationController::class, 'shareViaWhatsApp'])->name('quotations.share-whatsapp');});

require __DIR__.'/auth.php';
