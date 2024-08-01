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
        $contact = UpdateContact::find($id);

        if ($contact) {
            $contact->title = $title ?? $contact->title;
            $contact->address = $address ?? $contact->address;
            $contact->email = $email ?? $contact->email;
            $contact->number = $number ?? $contact->number;
            $contact->fb = $fb ?? $contact->fb;
            $contact->ig = $ig ?? $contact->ig;
            $contact->twitter = $twitter ?? $contact->twitter;
            $contact->in = $in ?? $contact->in;
            $contact->copyright = $copyright ?? $contact->copyright;
            $contact->save();

            return $contact;
        } else {
            return null;
        }
    }
}
