<?php

namespace App\Services;

use App\Models\API\V1\Admin\UpdateContact;

class UpdateContactServices
{
    public function createContact($name, $titleEn, $titleGe, $addressEn, $addressGe, $email, $number, $fb, $ig, $twitter, $in, $copyright)
    {
        $contact = new UpdateContact(); 
        $contact->name = $name;
        $contact->addressGe = $addressGe;
        $contact->addressEn = $addressEn;
        $contact->titleEn = $titleEn;
        $contact->titleGe = $titleGe;
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

    public function updateContact($id, $name, $titleEn, $titleGe, $addressEn, $addressGe, $email, $number, $fb, $ig, $twitter, $in, $copyright)
    {
        $contact = UpdateContact::find($id);

        if ($contact) {
            $contact->name = $name ?? $contact->name;
            $contact->titleEn = $titleEn ?? $contact->titleEn;
            $contact->titleGe = $titleGe ?? $contact->titleGe;
            $contact->addressEn = $addressEn ?? $contact->addressEn;
            $contact->addressGe = $addressGe ?? $contact->addressGe;
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
