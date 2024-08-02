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
            $product->update([
                'title' => $data['title'],
                'body' => $data['body']
            ]);
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