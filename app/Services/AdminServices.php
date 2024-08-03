<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;
use Illuminate\Support\Facades\Storage;

class AdminServices
{
    public function storeProduct($request)
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
                $productData['titlesEn'] = json_decode($request->titlesEn, true);
                $productData['titlesGe'] = json_decode($request->titlesGe, true);
                $productData['href'] = json_decode($request->href, true);
                $productData['images'] = json_decode($request->images, true);
            }

            $product = Admin::create($productData);

            if ($product) {
                return [
                    'success' => true,
                    'message' => $request->type == 1 ? 'Regular product created successfully' : 'Ultra product created successfully',
                    'data' => $product
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Product not created',
                    'data' => null
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error in AdminService@storeProduct: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred while creating the product',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getProduct($id)
    {
        return Admin::find($id);
    }

    public function updateProduct($id, $data)
    {
        $product = Admin::find($id);
        if ($product) {
            $updateData = [
                'titleEn' => $data['titleEn'],
                'titleGe' => $data['titleGe'],
            ];

            if (isset($data['bodyEn']) && isset($data['bodyGe'])) {
                $updateData['bodyEn'] = $data['bodyEn'];
                $updateData['bodyGe'] = $data['bodyGe'];
            }

            if (isset($data['titlesEn']) && isset($data['titlesGe'])) {
                $updateData['titlesEn'] = $data['titlesEn'];
                $updateData['titlesGe'] = $data['titlesGe'];
            }
            if (isset($data['href'])) {
                $updateData['href'] = $data['href'];
            }

            if (isset($data['images'])) {
                $updateData['images'] = $data['images'];
            }

            $product->update($updateData);
            return $product;
        }
        return false;
    }

    public function deleteProduct($id)
{
    $product = Admin::find($id);
    if ($product) {
        if ($product->images) {
            foreach ($product->images as $image) {
                $imagePath = str_replace('/storage/', '', $image);
                if (!Storage::disk('public')->delete($imagePath)) {
                    return false;
                }
            }
            return $product->delete();
        } else {
            return $product->delete();
        }
    }

    return false;
}

public function deleteProductImageByName($imageName)
{
    $imagePath = str_replace('/storage/', '', $imageName);
    if (Storage::disk('public')->delete($imagePath)) {
        return true;
    } else {
        return false;
    }
}

}
