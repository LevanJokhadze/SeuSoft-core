<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AdminController;
use App\Http\Controllers\API\V1\Admin\UpdateContactController;
use App\Http\Controllers\API\V1\Admin\AuthController;




// login
Route::post("/v1/admin/login", [AuthController::class, "login"]);
Route::post("/v1/admin/test", [AuthController::class, "testData"]);

Route::post("/v1/admin/store-product", [AdminController::class, "store"]);
Route::middleware('auth:sanctum')->group(function () {
    // header
    Route::put('/v1/admin/update-product/{title}', [AdminController::class, 'update']);

    // footer
    Route::post("/v1/admin/store-contact", [UpdateContactController::class, "store"]);
    Route::put('/v1/admin/update-contact/{title}', [UpdateContactController::class, 'update']);

    // reCaptcha
    Route::get('/recaptcha-site-key', [AuthController::class, 'getRecaptchaSiteKey']);
});