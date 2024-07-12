<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\API\V1\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    public function store(storeAdminRequest $request) 
    {
        $model = new Admin();
        $this->model = $request->id;
        $this->model = $request->title;
        $this->model = $request->body;
    }
}
