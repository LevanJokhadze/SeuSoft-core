<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\API\V1\Admin\FooterList;
use App\Http\Requests\StoreFooterListRequest;
use App\Http\Requests\UpdateFooterListRequest;
use App\Services\FooterListService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterListController extends Controller
{
    protected $footerListService;

    public function __construct(FooterListService $footerListService)
    {
        $this->footerListService = $footerListService;
    }

    public function store(StoreFooterListRequest $request)
    {   
        $list = $this->footerListService->createList(
            $request->title,
            $request->lists,
            $request->href
        );

        return response()->json([
            'message' => 'Contact created successfully',
            'data' => $list
        ], 201); 
    }

    public function update(Request $request, $id)
    {
        $updateLists = $this->footerListService->updateLists(
            $id,
            $request->title,
            $request->lists,
            $request->href
        );
    
        if ($updateLists) {
            return response()->json([
                'message' => 'Footer list updated successfully',
                'data' => $updateLists
            ], 200);
        } else {
            return response()->json([
                'message' => 'Footer list not found',
            ], 404);
        }
    }

    public function show() {
        $response = $this->footerListService->showFooterLists();

        if ($response) {
            return response()->json([
                'message' => 'Lists Fetch Success',
                'data' => $response
            ], 201); 
        } else {
            return response()->json([
                'message' => 'Fetch failed',
                'data' => $response
            ], 500);
        }
    }

    public function delete(Request $request, $id) {
        $response = $this->footerListService->deleteFooterLists($id);

        if ($response) {
            return response()->json([
                'message' => 'Lists Fetch Success',
                'data' => $response
            ], 201); 
        } else {
            return response()->json([
                'message' => 'Fetch failed',
                'data' => $response
            ], 500);
        }
    }
}
