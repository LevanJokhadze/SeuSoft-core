<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;

class UltraServices
{
    public function createUltraService($id, $title, $titlesArray, $imagesArray) 
    {
        $service = new Admin(); 
        $service->id = $id;
        $service->title = $title;
        $service->titles = $titlesArray;
        $service->images = $imagesArray;
        $service->save(); 
    
        return $service;
    }

    public function updateUltraService($id, $title, $titlesArray, $imagesArray)
    {
        $service = Service::find($id);
    
        if ($service) {
            $service->title = $title;  
            $service->titles = $titlesArray;  
            $service->images = $imagesArray;  
            $service->save();
            return $service;
        } else {
            return null;
        }
    }
}