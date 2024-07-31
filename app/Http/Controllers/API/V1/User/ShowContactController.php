<?php

namespace App\Http\Controllers\API\V1\User;

use App\Models\API\V1\Admin\UpdateContact;
use App\Http\Controllers\Controller;
use App\Services\ContactServices;

class ShowContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactServices $contactService) 
    {
        $this->contactService = $contactService;
    }
    
    public function index()
    {
        $contacts = UpdateContact::all();
        return response()->json(['data' => $contacts]);
    }

    public function show($id)
    {
        $contact = $this->contactService->getContactById($id);
        
        if ($contact) {
            return response()->json(['data' => $contact], 200);
        }
        
        return response()->json(['message' => 'Contact not found'], 404);
    }
}