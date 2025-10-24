<?php

namespace App\routes\api;

use Illuminate\Support\Facades\Route;
use Modules\HuntingBooking\Http\Controllers\GuideController;
use Modules\HuntingBooking\Http\Controllers\HuntingBookingController;

Route::get('/guides', [GuideController::class, 'index']);
Route::post('/bookings', [HuntingBookingController::class, 'store']);
