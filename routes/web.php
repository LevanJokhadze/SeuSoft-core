<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\AuthController;

Route::get('/{path?}', function () {
    return file_get_contents(public_path('../react/index.html'));
})->where('path', '^(?!api).*')->middleware('web');