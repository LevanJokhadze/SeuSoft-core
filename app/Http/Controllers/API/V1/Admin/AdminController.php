<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminServices;
use App\Services\UltraServices;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminServices;
    protected $ultraServices;

    public function __construct(AdminServices $adminServices, UltraServices $ultraServices)
    {
        $this->adminServices = $adminServices;
        $this->ultraServices = $ultraServices;
    }

    public function store(Request $request)
    {
        if ($request->type == 1) {
            $service = $this->adminServices->createService(
                $request->id, 
                $request->title, 
                $request->body, 
                $request->type
            );
            
            $message = 'Regular service created successfully';
        } else {
            $service = $this->ultraServices->createUltraService(
                $request->id, 
                $request->title,
                $request->titles,
                $request->images
            );
            
            $message = 'Ultra service created successfully';
        }

        return response()->json([
            'message' => $message,
            'data' => $service
        ], 201);
    }

    public function update(Request $request, $id)
    {
        if ($request->type == 1) {
            $service = $this->adminServices->updateService(
                $id, 
                $request->title, 
                $request->body
            );
        } else {
            $service = $this->ultraServices->updateUltraService(
                $id, 
                $request->titles, 
                $request->images
            );
        }

        if ($service) {
            return response()->json([
                'message' => 'Service updated successfully',
                'data' => $service
            ], 200);
        } else {
            return response()->json([
                'message' => 'Service not found',
            ], 404);
        }
    }
}