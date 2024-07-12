<?php

namespace App\Http\Controllers\API\V1\User;

use App\Models\API\V1\User\contact;
use App\Http\Requests\StorecontactRequest;
use App\Http\Requests\UpdatecontactRequest;
use App\Http\Controllers\Controller;
use App\Services\ContactServices;

class ContactController extends Controller
{
    protected $userService;

    public function __construct() 
    {
        $this->userService = new ContactServices();
    }
    public function store(StorecontactRequest $request)
    {
        $contact = $this->userService->saveContact(
            $request->id,
            $request->name,
            $request->last_name,
            $request->email,
            $request->number,
            $request->service,
            $request->company,
            $request->message,
        );
    
        if ($contact) {
            return response()->json([
                'message' => 'Contact created successfully',
                'data' => $contact
            ], 201);  
        }
    }

}