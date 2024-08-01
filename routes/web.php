<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AuthController;

Route::post("/v1/admin/login", [AuthController::class, "login"])->name('admin.login');