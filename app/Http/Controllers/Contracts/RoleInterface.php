<?php

namespace App\Http\Controllers\Contracts;

interface RoleInterface {
    // Function to get All
    public function index() : mixed;

    // Function to get by id
    public function getById(string $id) : mixed;

    // Function to store the data
    public function store($data);

    // Function to update
    public function update(string $id, $data);

    // Function to delete
    public function delete(string $id);
}