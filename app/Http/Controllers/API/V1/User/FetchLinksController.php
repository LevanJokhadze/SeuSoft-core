<?php

namespace App\Http\Controllers\API\V1\User;

use App\Models\API\V1\Admin\Admin;
use App\Http\Controllers\Controller;

class FetchLinksController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return response()->json(['data' => $admin]);
    }
}