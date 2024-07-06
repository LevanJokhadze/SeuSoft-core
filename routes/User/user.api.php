<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\User\UsersController;
use App\Http\Controllers\API\V1\User\ContactController;

Route::get("/v1/users", [UsersController::class, "index"]);
Route::post("/v1/contact", [ContactController::class, "store"]);
