<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse(
            ['user' => new UserResource($user), 'token' => $token],
            'Registro realizado com sucesso',
            201
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $key = 'login:' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return $this->errorResponse(
                "Muitas tentativas inválidas. Tente novamente em {$seconds} segundos.",
                429
            );
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            RateLimiter::hit($key, 60);
            return $this->errorResponse('Credenciais inválidas', 401);
        }

        RateLimiter::clear($key);
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse(
            ['user' => new UserResource($user), 'token' => $token],
            'Login realizado com sucesso',
            200
        );
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse([], 'Logout realizado com sucesso', 200);
    }
}
