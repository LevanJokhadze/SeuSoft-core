<?php
namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminServices;
use App\Services\UltraServices;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $adminServices;
    protected $ultraServices;

    public function __construct(AdminServices $adminServices, UltraServices $ultraServices)
    {
        $this->middleware('auth:sanctum');
        $this->adminServices = $adminServices;
        $this->ultraServices = $ultraServices;
    }

    public function store(StoreAdminRequest $request)
    {
        try {
            if ($request->type == 1) {
                $product = $this->adminServices->createService(
                    $request->id, 
                    $request->title, 
                    $request->body
                );
                
                $message = 'Regular product created successfully';
            } else {
                $product = $this->ultraServices->createUltraService(
                    $request->id, 
                    $request->title,
                    json_decode($request->titles),
                    $request->file('images')
                );
                
                $message = 'Ultra product created successfully';
            }
    
            return response()->json([
                'message' => $message,
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error in AdminController@store: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while creating the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $product = $this->adminServices->getProduct($id);
            
            if (!$product) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }

            return response()->json([
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in AdminController@edit: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while retrieving the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->adminServices->deleteProduct($id);
            
            if ($result) {
                return response()->json([
                    'message' => 'Product deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error in AdminController@delete: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while deleting the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}