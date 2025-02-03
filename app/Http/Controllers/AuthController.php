<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * User registration
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json($this->authService->register($request->validated()), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $token = $this->authService->login($request->validated());

        if(!$token){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->success([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], "Login successful");
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);
        return $this->success(null, "Logged out successfully");
    }

    public function user(Request $request): JsonResponse
    {
        return $this->success($request->user(), "User data retrieved successfully");
    }
}
