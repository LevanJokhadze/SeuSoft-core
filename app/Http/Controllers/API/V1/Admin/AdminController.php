<?php
namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\API\V1\Admin\Admin;
use App\Services\AdminServices;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected $adminServices;
    protected $uploadService;

    public function __construct(AdminServices $adminServices, UploadService $uploadService)
    {
        $this->adminServices = $adminServices;
        $this->uploadService = $uploadService;
    }
    
    public function store(StoreAdminRequest $request)
    {
        $result = $this->adminServices->storeProduct($request);

        if ($result['success']) {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'data' => $result['data']
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
                'error' => $result['error'] ?? null
            ], 500);
        }
    }

    public function upload(UploadRequest $request)
    {
        $result = $this->uploadService->uploadImage($request->file('image'));
        if ($result['success']) {
            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'url' => $result['url'],
                'name' => $result['name']
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
                'error' => $result['error'] ?? null
            ], 500);
        }

    
    }

    public function delete($id)
    {
        $deleted = $this->adminServices->deleteProduct($id);
            
        if ($deleted) {
            return response()->json([
                'status' => 'Product deleted successfully',
                'message' => $deleted
            ], 200);
        } else {
            return response()->json([
                'message' => $deleted,
            ], 404);
        }
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        try {
            $productData = [
                'titleEn' => $request->titleEn,
                'titleGe' => $request->titleGe,
            ];

            if ($request->type == 1) {
                $productData['bodyEn'] = $request->bodyEn;
                $productData['bodyGe'] = $request->bodyGe;
            } else {
                try {
                    $productData['titlesEn'] = json_decode($request->titlesEn, true);
                    $productData['titlesGe'] = json_decode($request->titlesGe, true);
                    $productData['aboutGe'] = json_decode($request->aboutGe, true);
                    $productData['aboutEn'] = json_decode($request->aboutEn, true);
                    $productData['href'] = json_decode($request->href, true);
                    $productData['images'] = json_decode($request->images, true);
                } catch (\JsonException $e) {
                    return response()->json([
                        'message' => 'Invalid JSON data for titles or images',
                        'error' => $e->getMessage()
                    ], 400);
                }
            }

            $result = $this->adminServices->updateProduct($id, $productData);

            if ($result) {
                return response()->json([
                    'message' => 'Product updated successfully',
                    'data' => $result
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error in AdminController@update: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while updating the product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteImage(Request $request)
    {
        $request->validate([
            'imageName' => 'required|string',
        ]);

        try {
            $deleted = $this->adminServices->deleteProductImageByName($request->imageName);
            
            if ($deleted) {
                return response()->json([
                    'status' => 'Image deleted successfully',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Image not found or could not be deleted',
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error in AdminController@deleteImage: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while deleting the image',
                'error' => $e->getMessage()
            ], 500);
        }
}


}