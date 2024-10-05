<?php

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;
use Spatie\Permission\Traits\HasRoles;


class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return response()->json(['message' => 'Wrong credentials'], 401);
        }

        $token = $user->createToken('AuthToken')->plainTextToken;

        $response = [
            'frontend_url' => env('FRONTEND_COOKIE', 'yourfrontend.test'),
            'user' => $user, // Replace UserResource with your own format or leave as is
            'token' => $token,
            'first_time_login' => $user->first_time_login,
        ];

        $cookie = cookie(
            'auth_token',
            $token,
            config('sanctum.expiration'),
            '/',
            env('FRONTEND_COOKIE', 'yourfrontend.test'),
            true,
            true,
            false,
            'lax'
        );

        return response()->json($response, 200)->withCookie($cookie);
    }
}
