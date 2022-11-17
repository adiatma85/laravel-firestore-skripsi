<?php

namespace App\Http\Controllers\Contracts;

interface UserInterface{

    // function to check whether email is already exist or not
    public function isEmailExist(string $email): bool;

    // function to store user
    public function store($data);

    // function to get user by email
    public function getByEmail(string $email) : mixed;
}