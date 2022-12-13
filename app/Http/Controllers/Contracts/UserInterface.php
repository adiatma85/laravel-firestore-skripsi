<?php

namespace App\Http\Controllers\Contracts;

interface UserInterface{

    // Function to get All
    public function index() : mixed;

    // Function to get by id
    public function getById(string $id) : mixed;

    // function to check whether email is already exist or not
    public function isEmailExist(string $email): bool;

    // function to get user by email
    public function getByEmail(string $email) : mixed;
    
    // function to store user
    public function store($data);

    // Function to update
    public function update(string $id, $data);

    // Function to delete
    public function delete(string $id);
}