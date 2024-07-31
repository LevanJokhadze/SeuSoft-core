<?php
namespace App\Services;

use App\Models\API\V1\User\Contact;

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
        $message
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

    public function getAllContacts()
    {
        return contact::all();
    }

    public function getContactById($id)
    {
        return Contact::find($id);
    }

    public function updateContact($id, array $data)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return false;
        }

        if ($contact->update($data)) {
            return $contact;
        } else {
            return false;
        }
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return false;
        }

        return $contact->delete();
    }
}