<?php
namespace App\Services;

use App\Models\API\V1\Admin\Admin;

class AdminServices
{
    public function createService($id, $title, $body)
    {
        $admin = new Admin(); 
        $admin->id = $id;
        $admin->title = $title;
        $admin->body = $body;
        $admin->save(); 
    
        return $admin;
    }

    public function updateService($id, $title, $body)
    {
        $admin = Admin::where('id', $id)->first();
    
        if ($admin) {
            $admin->title = $title;
            $admin->body = $body;
            $admin->save();
            return $admin;
        } else {
            return null;
        }
    }
}
