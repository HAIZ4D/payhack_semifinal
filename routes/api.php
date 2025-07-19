<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreenReceiptController;
// routes/api.php
use App\Http\Controllers\DonationController;

Route::post('/green-receipt', [GreenReceiptController::class, 'generate']);

