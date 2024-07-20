<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\API\V1\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function store(storeAdminRequest $request) 
    {
        $admin = new Admin(); 
        $admin->id = $request->id;
        $admin->title = $request->title;
        $admin->body = $request->body;
        $admin->save(); 
    
        return response()->json([
            'message' => 'Admin created successfully',
            'data' => $admin
        ], 201); 
    }

    public function update(Request $request, $title)
    {
        $admin = Admin::where('id', $request->id)->first();
    
        if ($admin) {
            $admin->title = $request->title;
            $admin->body = $request->body;
            $admin->save();
    
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
