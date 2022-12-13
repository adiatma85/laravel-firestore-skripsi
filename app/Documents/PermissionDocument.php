<?php

namespace App\Documents;

class PermissionDocument {

    public function __construct($row){
        $this->id = $row->id();
        // Core Data
        $this->title = $row->data()['title'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // title
    public String $title;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}