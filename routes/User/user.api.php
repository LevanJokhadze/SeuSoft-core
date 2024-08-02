<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\User\ContactController;
use App\Http\Controllers\API\V1\User\ShowContactController;
use App\Http\Controllers\API\V1\User\FetchLinksController;
use App\Http\Controllers\API\V1\Admin\FooterListController;

Route::get('/v1/contacts', [ShowContactController::class, 'index']);
Route::get('/v1/show-links', [FetchLinksController::class, 'index']);

Route::get('/v1/show-footer-links', [FooterListController::class, 'show']);

Route::prefix('v1/contacts')->group(function () {
    Route::post('/', [ContactController::class, 'store']);
});