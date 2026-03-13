<?php

namespace App\Services;

use App\Models\User;
use Tymon\JWTAuth\Payload;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService
{
    /**
     * Create access token
     */
    public function generateAccessToken(User $user): string
    {
        return JWTAuth::claims(['type' => 'access'])
            ->fromUser($user);
    }

    /**
     * Create refresh token
     */
    public function generateRefreshToken(User $user): string
    {
        JWTAuth::factory()->setTTL(config('jwt.refresh_ttl'));

        return JWTAuth::claims(['type' => 'refresh'])
            ->fromUser($user);
    }

    /**
     * Validate token
     */
    public function validate(string $token): Payload
    {
        return JWTAuth::setToken($token)->checkOrFail();
    }

    /**
     * Get user from token
     */
    public function getUserFromToken(string $token): ?User
    {
        return JWTAuth::setToken($token)->toUser();
    }
}
