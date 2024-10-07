<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $response = [
            'data' => [
                'message' => 'Registration failed.',
                'success' => false,
            ],
        ];

        try {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'name' => 'required|unique:users,name',
                'password' => 'required|min:8',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
                'verification_token' => Str::random(40)
            ]);

            $user->notify(new CustomVerifyEmail($user->verification_token));



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
