<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

// Contracts
use App\Http\Controllers\Contracts\TokenInterface;
use App\Http\Controllers\Contracts\UserInterface;


// Services
use App\Http\Controllers\Service\TokenService;
use App\Http\Controllers\Service\UserService;


class AuthController extends Controller{

    use ResponseTrait;

    protected TokenInterface $tokenService;
    protected UserInterface $userService;

    public function __construct(){
        $this->tokenService = new TokenService();
        $this->userService = new UserService();
    }

    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return $this->badRequestFailResponse($validateUser);
            }

            $user = $this->userService->getByEmail($request->input('email'));
            if (!$user) {
                return $this->response(false, 401, "invalid credential", null);
            }

            // Check the password
            $passwordMatch = Hash::check($request->input('password'), $user['password']);
            if (!$passwordMatch) {
                return $this->response(false, Response::HTTP_BAD_REQUEST, "password does not match", null);
            }

            // Create the token
            $token = $this->tokenService->generateToken($user);

            return $this->response(false, Response::HTTP_OK, "authenticated", $token);

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function register(Request $request){
        $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);
        
        if($validateUser->fails()){
            return $this->badRequestFailResponse($validateUser);
        }

        // Make sure that email is not duplicated
        $isEmailExist = $this->userService->isEmailExist($request->input('email'));
        if ($isEmailExist) {
            return $this->response(false, Response::HTTP_BAD_REQUEST, "email is already exist", null);
        }

        // If there are not duplicated email, then hash the password
        $hashedPassword = Hash::make($request->input('password'));
        $userData = [
            "email" => $request->input('email'),
            "password" => $hashedPassword
        ];

        // Store the user data
        $this->userService->store($userData);

        // If finish, create new token
        $token = $this->tokenService->generateToken($userData);
        return $this->response(false, Response::HTTP_OK, "register success", compact('token'));
    }
}