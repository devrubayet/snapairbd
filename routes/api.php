<?php

use App\Http\Controllers\AirlinesController;
use App\Http\Controllers\ExclusiveOfferController;
use App\Http\Controllers\SiteSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/settings',[SiteSettingsController::class,'update'])->name('settings');
Route::get('/settings',[SiteSettingsController::class,'SiteSettings'])->name('settings');


Route::get('/exclusive_offers',[ExclusiveOfferController::class,'Exclusive_offer'])->name('offers');
Route::post('/offers',[ExclusiveOfferController::class,'store']);
Route::put('/offers/{id}',[ExclusiveOfferController::class,'update']);
Route::delete('/offers/{id}',[ExclusiveOfferController::class,'destroy']);


Route::get('/airlines', [AirlinesController::class,'index']);
Route::post('/airlines',[AirlinesController::class,'storeAir']);