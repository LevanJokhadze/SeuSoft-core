<?php

namespace App\Http\Controllers\API\V1\Admin;

use Illuminate\Http\Request;
use App\Models\API\V1\Admin\Auth as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AuthController {

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha_token' => 'required',
        ]);

        Log::info('Login attempt', ['email' => $credentials['email']]);

        $recaptchaScore = $this->verifyRecaptcha($credentials['recaptcha_token']);

        if ($recaptchaScore === false || $recaptchaScore < 0.5) {
            Log::warning('Login failed: Invalid reCAPTCHA', ['email' => $credentials['email']]);
            return response()->json(['message' => 'Invalid reCAPTCHA'], 400);
        }

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            Log::warning('Login failed: User not found', ['email' => $credentials['email']]);
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            Log::warning('Login failed: Invalid password', ['email' => $credentials['email']]);
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        
        Log::info('Login successful', ['email' => $credentials['email']]);

        return response()->json([
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
                Log::error('reCAPTCHA verification failed: ' . json_encode($body['error-codes']));
                return false;
            }

            return $body['score'];
        } catch (\Exception $e) {
            Log::error('reCAPTCHA validation error: ' . $e->getMessage());
            return false;
        }
    }

    public function getRecaptchaSiteKey()
    {
        return response()->json([
            'site_key' => config('services.recaptcha.site_key')
        ]);
    }
}