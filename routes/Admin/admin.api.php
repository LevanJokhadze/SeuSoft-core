<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AdminController;
use App\Http\Controllers\API\V1\Admin\UpdateContactController;
use App\Http\Controllers\API\V1\Admin\AuthController;
use App\Http\Controllers\API\V1\User\ContactController;

// Public routes
Route::post("/v1/admin/test", [AuthController::class, "createTestUser"]);
Route::post("/v1/admin/login", [AuthController::class, "login"])->name('login');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/list-contacts', [ContactController::class, 'index']);
    Route::post("/v1/admin/store-product", [AdminController::class, "store"]);
    Route::post('/v1/admin/upload', [AdminController::class, 'upload']);

    // Route::put('/v1/admin/update-product', [AdminController::class, 'update']);
    Route::put('/v1/admin/update-contact', [UpdateContactController::class, 'update']);
    Route::get('/recaptcha-site-key', [AuthController::class, 'getRecaptchaSiteKey']);

    // New routes
    Route::get("/v1/admin/edit-product/{id}", [AdminController::class, "edit"]);
    Route::delete("/v1/admin/delete-product/{id}", [AdminController::class, "delete"]);
});