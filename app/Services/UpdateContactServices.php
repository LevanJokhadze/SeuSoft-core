<?php
namespace App\Services;

use App\Models\API\V1\Admin\UpdateContact;

class UpdateContactServices
{
    public function createContact($id, $title, $address, $email, $number, $fb, $ig, $twitter, $in, $copyright)
    {
        $admin = new UpdateContact(); 
        $admin->id = $id;
        $admin->title = $title;
        $admin->address = $address;
        $admin->email = $email;
        $admin->number = $number;
        $admin->fb = $fb;
        $admin->ig = $ig;
        $admin->twitter = $twitter;
        $admin->in = $in;
        $admin->copyright = $copyright;
        $admin->save(); 
    
        return $admin;
    }

    public function updateContact($id, $title, $address, $email, $number, $fb, $ig, $twitter, $in, $copyright)
    {
        $admin = UpdateContact::where('id', $id)->first();
    
        if ($admin) {
            $admin->title = $title;
            $admin->address = $address;
            $admin->email = $email;
            $admin->number = $number;
            $admin->fb = $fb;
            $admin->ig = $ig;
            $admin->twitter = $twitter;
            $admin->in = $in;
            $admin->copyright = $copyright;
            $admin->save();
            return $admin;
        } else {
            return null;
        }
    }
}
