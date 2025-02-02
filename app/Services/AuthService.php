<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    /**
     * Register a new user.
     */
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Login user and return a token.
     */
    public function login(array $credentials)
    {
        if(!Auth::attempt($credentials)){
            return null;
        }

        $user = Auth::user();
        return $user->createToken('authToken')->plainTextToken;
    }

    /**
     * Logout user (Revoke the token).
     */
    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }

    /**
     * Get the currently authenticated user.
     */
    public function user(Request $request)
    {
        return $request->user();
    }
}
