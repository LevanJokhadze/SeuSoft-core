<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AdminController;
use App\Http\Controllers\API\V1\Admin\UpdateContactController;
use App\Http\Controllers\API\V1\Admin\AuthController;
use App\Http\Controllers\API\V1\User\ContactController;

// login
Route::group(['middleware' => ['cors']], function () {
    Route::post("/v1/admin/login", [AuthController::class, "login"]);
});

// List contacts
Route::get('/v1/list-contacts', [ContactController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    // header
    Route::post("/v1/admin/store-product", [AdminController::class, "store"]);
    Route::post("/v1/admin/store-contact", [UpdateContactController::class, "store"]);
    Route::put('/v1/admin/update-product/{title}', [AdminController::class, 'update']);

    // footer
    Route::put('/v1/admin/update-contact/{title}', [UpdateContactController::class, 'update']);

    // reCaptcha
    Route::get('/recaptcha-site-key', [AuthController::class, 'getRecaptchaSiteKey']);
});
