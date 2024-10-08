<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token, $email)
    {
        // Find the user by email and token
        $user = User::where('email', $email)->where('verification_token', $token)->first();
    
        if (!$user) {
            // If user not found or token is invalid
            return response()->json(['message' => 'Invalid token or email.'], 404);
        }
    
        // Verify the user's email and clear the token
        $user->email_verified_at = now();
        $user->verification_token = null; // Clear the token after verification
        $user->save();
    
        return response()->json(['message' => 'Email verified successfully!']);
    }
}
