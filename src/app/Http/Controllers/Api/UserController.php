<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;
use Illuminate\Support\Facades\Hash;

// Contracts
use App\Http\Controllers\Contracts\UserInterface;

// Service
use App\Http\Controllers\Service\UserService;

class UserController extends Controller
{

    use ResponseTrait;
    use CommonTrait;

    protected UserInterface $userService;

    public const DOCUMENT = "users";
    public const STORAGE = "users/";

    public function __construct(){
        $this->userService = new UserService();
    }

    public function index(){
        $users = $this->userService->index();
        return $this->successResponse("success fetching resources", $users);
    }

    public function show($id){
        $user = $this->userService->getById($id);
        return $this->successResponse("success fetching resources", $user);
    }

    public function store(Request $request){

        $hashedPassword = Hash::make($request->input('password'));

        $data = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "password" => $hashedPassword
        ];

        // Store the data
        $this->userService->store($data);

        return $this->successResponse("success created resources", null);
    }

    public function update(Request $request, $id){
        $row = $this->userService->getById($id);

        $data = [
            "name" => $request->input('name') ? $request->input('name') : $row->data()['name'] ?? "",
            "email" => $request->input('email') ? $request->input('email') : $row->data()['email'] ?? "",
            "password" => $request->input('password') ? Hash::make($request->input('password')) : $row->data()['password'] ?? "",
        ];

        $this->userService->update($id, $data);

        return $this->successResponse("success update resuource", null);
    }

    // Random delete
    public function destroy($id){
        $id = $this->userService->index()[0]->id;
        $this->userService->delete($id);

        return $this->successResponse("success delete resuource", null);
    }
}
