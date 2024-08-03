<?php

namespace App\Http\Controllers\API\V1\User;

use App\Models\API\V1\User\contact;
use App\Http\Requests\StorecontactRequest;
use App\Http\Requests\UpdatecontactRequest;
use App\Http\Controllers\Controller;
use App\Services\ContactServices;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;

class ContactController extends Controller
{
    protected $userService;

    public function __construct() 
    {
        $this->userService = new ContactServices();
    }
    public function store(StoreContactRequest $request)
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
            Mail::to('sandrosmeili@gmail.com')->send(new ContactNotification([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'number' => $request->number,
                'service' => $request->service,
                'company' => $request->company,
                'message' => $request->message,
            ]));

            return response()->json([
                'message' => 'Contact created | Notif send',
                'data' => $contact
            ], 201);  
        }

        return response()->json([
            'message' => 'Failed to create contact',
        ], 500);
    }

    public function index() {
        $contact = contact::all();
        return response()->json(['data' => $contact]);
    }

}