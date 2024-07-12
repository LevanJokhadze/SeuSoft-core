<?php
namespace App\Services;

use App\Models\API\V1\User\contact;
use App\Http\Requests\StorecontactRequest;

class ContactServices
{
    public function saveContact(
        $id,
        $name,
        $last_name,
        $email,
        $number,
        $service,
        $company,
        $message,
        )
    {
        $contact = new Contact;
        $contact->id = $id;
        $contact->name = $name;
        $contact->last_name = $last_name;
        $contact->email = $email;
        $contact->number = $number;
        $contact->service = $service;
        $contact->company = $company;
        $contact->message = $message;

        if ($contact->save()) {
            return $contact;
        } else {
            return false;
        }
    }

    public function updateUser($userId, array $data)
    {

    }
}