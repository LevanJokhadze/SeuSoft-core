<?php
namespace App\Http\Controllers\API\V1\User;

use App\Models\API\V1\Admin\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FetchLinksController extends Controller
{
    public function index(): JsonResponse
    {
        // Fetch all data from the Admin model
        $admins = Admin::all();

        // Iterate over each admin entry to encode binary images to base64
        foreach ($admins as $admin) {
            if ($admin->images) {
                $imagesArray = json_decode($admin->images, true);
                foreach ($imagesArray as $index => $image) {
                    $imagesArray[$index] = base64_encode($image);
                }
                $admin->images = json_encode($imagesArray);
            }
        }

        // Return the modified data as JSON response
        return response()->json(['data' => $admins]);
    }
}
