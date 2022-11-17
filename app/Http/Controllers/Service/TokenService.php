<?php

namespace App\Http\Controllers\Service;

use Illuminate\Support\Carbon;
use Firebase\JWT\JWT;

// Interface
use App\Http\Controllers\Contracts\TokenInterface;

// Reference https://github.com/firebase/php-jwt
class TokenService implements TokenInterface {

    protected const ALG = "HS256";
    protected $key;

    public function __construct(){
        $this->key = env('JWT_SECRET', 'secret');
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