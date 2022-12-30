<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // Reference https://github.com/firebase/php-jwt
    public function handle(Request $request, Closure $next)
    {
        try {
            $decoded = JWT::decode($request->header('authorization'), env('JWT_KEY', 'secret'));
        } catch (InvalidArgumentException $e) {
            // provided key/key-array is empty or malformed.
            return response()->json('invalid argument');
        } catch (DomainException $e) {
            // provided algorithm is unsupported OR
            // provided key is invalid OR
            // unknown error thrown in openSSL or libsodium OR
            // libsodium is required but not available.
            return response()->json('domain exception');
        } catch (SignatureInvalidException $e) {
            // provided JWT signature verification failed.
            return response()->json('signature invalid exception');
        } catch (BeforeValidException $e) {
            // provided JWT is trying to be used before "nbf" claim OR
            // provided JWT is trying to be used before "iat" claim.
        } catch (ExpiredException $e) {
            // provided JWT is trying to be used after "exp" claim.
            return response()->json('expired exception');
        } catch (UnexpectedValueException $e) {
            // provided JWT is malformed OR
            // provided JWT is missing an algorithm / using an unsupported algorithm OR
            // provided JWT algorithm does not match provided key OR
            // provided key ID in key/key-array is empty or invalid.
            return response()->json('unexpected value exception');
        }
        
        return $next($request);
    }
}
