<?php
namespace App\Http\Controllers\API\V1\Admin;

use Illuminate\Http\Request;
use App\Models\API\V1\Admin\Auth as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\TestAuthRequest;

class AuthController extends Controller 
{
    public function login(TestAuthRequest $request)
    {
        $credentials = $request->validated();

        $recaptchaScore = $this->verifyRecaptcha($credentials['recaptcha_token']);

        if ($recaptchaScore === true || $recaptchaScore < 0) {
            return response()->json(['message' => 'Invalid reCAPTCHA'], 400);
        }
        
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    private function verifyRecaptcha($token)
    {
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $token
            ]);
            $body = $response->json();
            if (!$body['success']) {
                return false;
            }
            return $body['score'];
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getRecaptchaSiteKey()
    {
        return response()->json([
            'site_key' => config('services.recaptcha.site_key')
        ]);
    }

    public function createTestUser()
    {
        try {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => Hash::make('password123'),
            ]);

            return response()->json([
                'message' => 'Test user created successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create test user: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create test user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}