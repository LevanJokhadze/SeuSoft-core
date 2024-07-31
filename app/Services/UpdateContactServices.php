<?php
namespace App\Services;

use App\Models\API\V1\Admin\UpdateContact;

class UpdateContactServices
{
    public function createContact($title, $address, $email, $number, $fb, $ig, $twitter, $in, $copyright)
    {
        $contact = new UpdateContact(); 
        $contact->title = $title;
        $contact->address = $address;
        $contact->email = $email;
        $contact->number = $number;
        $contact->fb = $fb;
        $contact->ig = $ig;
        $contact->twitter = $twitter;
        $contact->in = $in;
        $contact->copyright = $copyright;
        $contact->save(); 
    
        return $contact;
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
