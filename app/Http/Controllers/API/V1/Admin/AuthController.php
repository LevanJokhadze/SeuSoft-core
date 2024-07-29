<?php

namespace App\Http\Controllers\API\V1\Admin;

use Illuminate\Http\Request;
use App\Models\API\V1\Admin\Auth as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

class AuthController {

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha_token' => 'required',
        ]);

        Log::info('Login attempt', ['email' => $credentials['email']]);

        $recaptchaScore = $this->verifyRecaptcha($credentials['recaptcha_token'], 'login_action');

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

    private function verifyRecaptcha($token, $action)
    {
        try {
            $client = new RecaptchaEnterpriseServiceClient();
            $projectName = $client->projectName(config('services.recaptcha.project_id'));

            $event = (new Event())
                ->setSiteKey(config('services.recaptcha.site_key'))
                ->setToken($token);

            $assessment = (new Assessment())
                ->setEvent($event);

            $response = $client->createAssessment($projectName, $assessment);

            if ($response->getTokenProperties()->getValid() == false) {
                Log::error('reCAPTCHA token invalid: ' . InvalidReason::name($response->getTokenProperties()->getInvalidReason()));
                return false;
            }

            if ($response->getTokenProperties()->getAction() != $action) {
                Log::error('reCAPTCHA action mismatch');
                return false;
            }

            return $response->getRiskAnalysis()->getScore();
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