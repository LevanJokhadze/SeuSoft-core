<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\User\ContactController;
use App\Http\Controllers\API\V1\User\ShowContactController;

Route::get('/v1/contacts', [ShowContactController::class, 'index']);

Route::prefix('v1/contacts')->group(function () {
    Route::post('/', [ContactController::class, 'store']);


    Route::get('/{id}', [ShowContactController::class, 'show']);

    Route::put('/{id}', [ContactController::class, 'update']);

    Route::delete('/{id}', [ContactController::class, 'destroy']);
});