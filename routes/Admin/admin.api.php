<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AuthController;
use App\Http\Controllers\API\V1\Admin\UpdateContactController;
use App\Http\Controllers\API\V1\Admin\AdminController;
use App\Http\Controllers\API\V1\User\ContactController;
use App\Http\Controllers\API\V1\Admin\FooterListController;

// For Tesssting
Route::post("/v1/admin/test", [AuthController::class, "createTestUser"]);


// Login
Route::post("/v1/admin/login", [AuthController::class, "login"])->name('login');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/list-contacts', [ContactController::class, 'index']);
    Route::post("/v1/admin/store-product", [AdminController::class, "store"]);
    Route::post("/v1/admin/delete-image", [AdminController::class, "deleteImage"]);

    // Footer items
    Route::post("/v1/admin/store-links", [FooterListController::class, "store"]);
    Route::put("/v1/admin/edit-links/{id}", [FooterListController::class, "update"]);
    Route::put("/v1/admin/delete-links/{id}", [FooterListController::class, "delete"]);

    Route::post('/v1/admin/upload', [AdminController::class, 'upload']);

    Route::put('/v1/admin/update-contact', [UpdateContactController::class, 'update']);
    Route::post('/v1/admin/add-contact', [UpdateContactController::class, 'store']);
    Route::get('/recaptcha-site-key', [AuthController::class, 'getRecaptchaSiteKey']);
    
    Route::put("/v1/admin/edit-contact/{id}", [UpdateContactController::class, "update"]);
    Route::put("/v1/admin/edit-product/{id}", [AdminController::class, "update"]);
    Route::delete("/v1/admin/delete-product/{id}", [AdminController::class, "delete"]);
});
