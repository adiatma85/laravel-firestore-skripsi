<?php

namespace App\Http\Controllers\Service;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Carbon;
use Firebase\JWT\JWT;

// Interface
use App\Http\Controllers\Contracts\TokenInterface;

// Reference https://github.com/firebase/php-jwt
class TokenService implements TokenInterface {

    public const ALG = "HS256";
    public string $key;

    public function __construct(){
        $this->key = env('JWT_SECRET');
    }

    // Generate token
    public function generateToken($user) : string{
        $payload = [
            "user" => $user,
            "iat" => Carbon::now(),
        ];

        $token = JWT::encode($payload, $this->key, static::ALG);

        return $token;
    }
}