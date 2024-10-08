<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'name' => 'required|unique:users,name',
                'password' => 'required|min:6',
                'phone' => 'required|string|unique:users,phone',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => bcrypt($request->input('password')),
                'verification_token' => Str::random(40),
            ]);

            Mail::to($user->email)->queue(new VerificationMail($user));

            $response['data']['message'] = 'User registered, please verify your email.';
            $response['data']['success'] = true;
        } catch (ValidationException $e) {
            $response['data']['message'] = 'Validation failed.';
            $response['data']['errors'] = $e->validator->errors();
        } catch (\Exception $e) {
            $response['data']['message'] = 'Registration failed. Please try again.';
            $response['data']['error'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
