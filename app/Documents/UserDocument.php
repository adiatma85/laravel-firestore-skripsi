<?php

namespace App\Documents;

class UserDocument {

    public function __construct($row){
        $this->id = $row->id();
        // Core Data
        $this->name = $row->data()['name'] ?? "";
        $this->email = $row->data()['email'] ?? "";
        $this->password = $row->data()['password'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // user_id
    public String $user_id;

    // family_id
    public String $family_id;

    // Nama Lengkap
    public String $fullname;

    // name
    public String $name;

    // email
    public String $email;

    // password
    public String $password;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}