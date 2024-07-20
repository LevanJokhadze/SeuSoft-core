<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\API\V1\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Services\AdminServices;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    protected $adminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
    }

    public function store(StoreAdminRequest $request)
    {
        $admin = $this->adminServices->createService($request->id, $request->title, $request->body);

        return response()->json([
            'message' => 'Admin created successfully',
            'data' => $admin
        ], 201); 
    }

    public function update(Request $request, $id)
    {
        $admin = $this->adminServices->updateService($id, $request->title, $request->body);

        if ($admin) {
            return response()->json([
                'message' => 'Admin updated successfully',
                'data' => $admin
            ], 200);
        } else {
            return response()->json([
                'message' => 'Admin not found',
            ], 404);
        }
    }
    
}
