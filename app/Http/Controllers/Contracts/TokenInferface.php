<?php

namespace App\Http\Controllers\Contracts;

interface TokenInterface {
    // Generate Token
    public function generateToken($user): string;
}