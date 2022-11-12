<?php

// Finalize "register" function

namespace App\Http\Controllers\Service;

class UserService {

    public const DOCUMENT = "users";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }


    // Function to check whether email is exist or not
    // Return boolean
    public function isEmailExist(string $email) : bool{
        $documents = $this->firestore->where('email', '=', $email);

        foreach ($documents as $row) {
            $databaseEmail = $row->data()['email'] ?? "";
            if ($email == $databaseEmail) {
                return true;
            }
        }

        return false;
    }

    // Store the user
    public function store($data){
        $newDocument = $this->firestore->newDocument();
        $newDocument->set($data);
    }
}