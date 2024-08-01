<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;
use Illuminate\Support\Facades\Log;

class UltraServices
{
    public function createUltraService($id, $title, $titlesArray, $images) 
    {
        try {
            $service = new Admin(); 
            $service->id = $id;
            $service->title = $title;
            $service->titles = json_encode($titlesArray);
            
            if ($images) {
                $imagesArray = $this->processImages($images);
                $service->images = json_encode($imagesArray);
            }
            
            $service->save(); 
        
            return $service;
        } catch (\Exception $e) {
            Log::error('Error in createUltraService: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateUltraService($id, $title, $titlesArray, $images)
    {
        try {
            $service = Admin::find($id);
        
            if ($service) {
                $service->title = $title;  
                $service->titles = json_encode($titlesArray);  
                
                if ($images) {
                    $imagesArray = $this->processImages($images);
                    $service->images = json_encode($imagesArray);
                }
                
                $service->save();
                return $service;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error in updateUltraService: ' . $e->getMessage());
            throw $e;
        }
    }

    private function processImages($images)
    {
        $imagesArray = [];
        foreach ($images as $image) {
            if ($image->isValid()) {
                $imagesArray[] = base64_encode(file_get_contents($image->getRealPath()));
            }
        }
        return $imagesArray;
    }
}