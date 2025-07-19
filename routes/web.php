<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreenReceiptController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EcoPointController;

Route::get('/green-receipt-demo', [GreenReceiptController::class, 'demoForm']);
Route::post('/green-receipt-demo', [GreenReceiptController::class, 'demoSubmit']);

Route::get('/shop', [GreenReceiptController::class, 'showShop']);
Route::post('/donation-popup', [GreenReceiptController::class, 'donationPrompt']);
Route::post('/donation-submit', [GreenReceiptController::class, 'donationSubmit']);
Route::post('/checkout', [GreenReceiptController::class, 'processCheckout']);


Route::get('/receipt', function () {
    $total = 9.60;
    $rounded = ceil($total);
    $donationAmount = round($rounded - $total, 2);
    $suggestion = "Would you like to round up RM{$donationAmount} to support clean water projects?";

    return view('receipt', compact('total', 'donationAmount', 'suggestion'));
});

Route::get('/eco-redeem', [EcoPointController::class, 'showRedeemPage'])->name('eco.redeem');