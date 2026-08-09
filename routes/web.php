<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AirlinesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExclusiveOfferController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/dashboard', [UserController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


/* =============================== Admin End ========================== */
// Route::middleware(['auth', 'admin'])->group(function () {
// Admin Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');
// Route::get('/admin/siteinfo', [AdminController::class, 'siteInfo'])->name('siteinfo');

// client
Route::get(
    'clients/{client}/add-visa',
    [ClientController::class, 'addVisa']
)->name('clients.addVisa');

Route::post(
    'clients/{client}/add-visa',
    [ClientController::class, 'storeVisa']
)->name('clients.storeVisa');
Route::get(
    'clients/{client}/add-service',
    [ClientController::class, 'addService']
)->name('clients.addService');

Route::post(
    'clients/{client}/add-service',
    [ClientController::class, 'storeService']
)->name('clients.storeService');

Route::get(
    'clients/{client}/invoices/create',
    [ClientController::class, 'createInvoice']
)->name('clients.createInvoice');
Route::post(
    'clients/{client}/invoices',
    [ClientController::class, 'storeInvoice']
)->name('clients.storeInvoice');
Route::get(
    'clients/{client}/invoices/{invoice}/payment',
    [ClientController::class, 'createPayment']
)->name('clients.createPayment');

Route::post(
    'clients/{client}/invoices/{invoice}/payment',
    [ClientController::class, 'storePayment']
)->name('clients.storePayment');


Route::get(
    'clients/{client}/invoices/{invoice}',
    [ClientController::class, 'showInvoice']
)->name('clients.showInvoice');
Route::get(
    '/clients/{client}/payments/{payment}/receipt',
    [ClientController::class, 'showPaymentReceipt']
)->name('clients.paymentReceipt');
Route::resource('clients', ClientController::class);
// Route::get('/admin/all-client', [ClientController::class,'index'])->name('client.index');
// Route::get('/admin/create-client', [ClientController::class,'create'])->name('client.create');
// Route::post('/admin/client-store', [ClientController::class,'store'])->name('client.store');
// Route::POST('/admin/clients/ajax', [ClientController::class, 'indexAjax'])->name('client.index.ajax');
// Route::get('/admin/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
// Route::get('/admin/client/{id}/overview', [ClientController::class, 'overview'])->name('client.overview');



//     Route::get('invoice/create/{visa}', [InvoiceController::class, 'create'])->name('invoice.create');

//     // Store invoice
//     Route::post('invoice/store/{visa}', [InvoiceController::class, 'store'])->name('invoice.store');

//     // (পরবর্তীতে) Invoice index/list page
//     Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
//     Route::get('invoice-show/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
//     Route::get('invoice-download/{id}', [InvoiceController::class, 'download'])->name('invoice.download');

//     // Visa Tracking
//     Route::get('/admin/visa-status', [VisaController::class, 'index'])->name('admin.visa');
//     Route::get('/admin/create-visatrack', [VisaController::class, 'create'])->name('create-visa');
//     Route::post('/admin/store-visa', [VisaController::class, 'store'])->name('visa-store');
//     Route::get('/admin/edit-visa/{id}', [VisaController::class, 'edit'])->name('visa-edit');
//     Route::put('/admin/update-visa/{id}', [VisaController::class, 'update'])->name('visa-update');
//     Route::delete('/admin/delete-visa/{id}', [VisaController::class, 'destroy'])->name('visa-delete');
//     // POST for Visa Tracking AJAX JSON
//     Route::post('/admin/visa-status', [VisaController::class, 'indexAjax'])->name('visa-status.index');

//     // Testimonial Urls
Route::get('/admin/all-testimonial', [TestimonialsController::class, 'index'])->name('all-testi');
Route::get('/admin/create-testimonial', [TestimonialsController::class, 'createTestimonials'])->name('create-testi');
Route::post('/admin/store-testimonial', [TestimonialsController::class, 'storeTestimonial'])->name('store-testi');
Route::get('/admin/edit-testimonial/{id}', [TestimonialsController::class, 'edit'])->name('edit-testi');
Route::put('/admin/update-testimonial/{id}', [TestimonialsController::class, 'update'])->name('update-testi');
Route::delete('/admin/delete-testimonial/{id}', [TestimonialsController::class, 'destroy'])->name('delete-testi');



//     // Airlines Urls
Route::get('/admin/all-airlines', [AirlinesController::class, 'index'])->name('showAirlines');
Route::get('/admin/create-airline', [AirlinesController::class, 'createAir'])->name('create-airline');
Route::post('/admin/create-airline', [AirlinesController::class, 'storeAir'])->name('store-airline');
Route::get('/admin/edit-airline/{id}', [AirlinesController::class, 'editAir'])->name('edit-airline');
Route::put('/admin/update-airline/{id}', [AirlinesController::class, 'updateAir'])->name('update-airline');
Route::delete('/admin/delete-airline/{id}', [AirlinesController::class, 'destroy'])->name('delete-airline');



//     // Route::prefix('visa-status')->name('visa-status.')->group(function () {
//     Route::post('/', [VisaController::class, 'index'])->name('index');
//     // });

//     // Our service List Urls
Route::get('/admin/all-slider', [ExclusiveOfferController::class, 'index'])->name('all-slider');
Route::get('/admin/services-create', [ExclusiveOfferController::class, 'create'])->name('service-create');
Route::post('/admin/services-store', [ExclusiveOfferController::class, 'store'])->name('services-store');
Route::put('/admin/services-update/{id}', [ExclusiveOfferController::class, 'update'])->name('services-update');
Route::get('/admin/services-edit/{id}', [ExclusiveOfferController::class, 'edit'])->name('services-edit');
Route::delete('/admin/our-services/{id}', [ExclusiveOfferController::class, 'destroy'])->name('services-destroy');
Route::patch('/admin/our-services/{id}/toggle', [ExclusiveOfferController::class, 'toggle'])->name('services-toggle');

// Site Settings Urls
Route::get('/admin/settings', [SiteSettingsController::class, 'edit'])->name('settings-edit');
Route::post('/admin/settings', [SiteSettingsController::class, 'update'])->name('settings-update');

//     // Bank Details Urls
//     Route::get('/admin/all-bank',[BankController::class,'index'])->name('all-bank');
//     Route::get('/admin/bank-create',[BankController::class,'create'])->name('bank-create');
//     Route::post('/admin/bank-store',[BankController::class,'store'])->name('bank.store');
//     Route::get('/admin/bank-edit/{id}',[BankController::class,'edit'])->name('bank.edit');
//     Route::put('/admin/bank-update/{id}',[BankController::class,'update'])->name('bank.update');
//     Route::delete('/admin/bank-delete/{id}', [BankController::class, 'destroy'])->name('bank-destroy');


// });





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
