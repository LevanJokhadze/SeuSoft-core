<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;

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
                'title' => $data['title'],
            ];

            if (isset($data['body'])) {
                $updateData['body'] = $data['body'];
            }

            if (isset($data['titles'])) {
                $updateData['titles'] = $data['titles'];
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
            return $product->delete();
        }
        return false;
    }
}