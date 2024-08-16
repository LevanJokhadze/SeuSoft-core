<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UpdateContactServices;

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
            $request->name,
            $request->titleEn,
            $request->titleGe,
            $request->addressEn,
            $request->addressGe,
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
        ], 200); 
    }

    public function update(Request $request, $id)
    {
        $contact = $this->updateContactService->updateContact(
            $id,
            $request->name,
            $request->titleEn,
            $request->titleGe,
            $request->addressEn,
            $request->addressGe,
            $request->email,
            $request->number,
            $request->fb,
            $request->ig,
            $request->twitter,
            $request->in,
            $request->copyright
        );

        if ($contact) {
            return response()->json([
                'message' => 'Contact updated successfully',
                'data' => $contact
            ], 200);
        } else {
            return response()->json([
                'message' => 'Contact not found',
            ], 404);
        }
    }
}
