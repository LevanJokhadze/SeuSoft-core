<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateContactRequest;
use App\Http\Requests\UpdateUpdateContactRequest;
use App\Services\UpdateContactServices;
use Illuminate\Http\Request;

class UpdateContactController extends Controller
{
    protected $updateContactService;

    public function __construct(UpdateContactServices $updateContactService)
    {
        $this->updateContactService = $updateContactService;
    }

    public function store(Request $request)
    {
        $contact = $this->updateContactService->createContact(
            $request->title,
            $request->address,
            $request->email,
            $request->number,
            $request->fb,
            $request->ig,
            $request->twitter,
            $request->in,
            $request->copyright
        );

        return response()->json([
            'message' => 'Contact created successfully',
            'data' => $contact
        ], 201); 
    }

    public function update(storeUpdateContactRequest $request)
    {
        $admin = $this->updateContactService->updateContact($request->id, $request->title, $request->address, $request->email, $request->number, $request->fb, $request->ig, $request->twitter, $request->in, $request->copyright);

        if ($admin) {
            return response()->json([
                'message' => 'Admin updated successfully',
                'data' => $admin
            ], 200);
        } else {
            return response()->json([
                'message' => 'Admin not found',
            ], 404);
        }
    }
    
}