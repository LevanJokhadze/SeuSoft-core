<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;
use Illuminate\Support\Facades\Storage;

class AdminServices
{
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
