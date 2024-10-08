<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }
}
