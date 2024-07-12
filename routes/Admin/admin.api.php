<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AdminController;

Route::post("/v1/admin/store-product", [AdminController::class, "store"]);
Route::put('/v1/admin/update-product/{title}', [AdminController::class, 'update']);
