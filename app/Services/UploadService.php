<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadService
{
   public function uploadImage($image) {
    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    $imageName = $originalName . '_' . rand(1000, 99999) . '.' . $image->getClientOriginalExtension();

    $imagePath = $image->storeAs('images', $imageName, 'public');

    if ($imagePath) {
        return [
            'success' => true,
            'message' => 'Image Saved Successfully',
            'url' => Storage::url($imagePath),
            'name' => $imageName
        ];
    } else {
        return [
            'error' => false,
            'message' => 'Image not saved',
            'error' => null
        ];
    }
   }
}