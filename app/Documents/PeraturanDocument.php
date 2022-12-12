<?php

namespace App\Documents;

class PeraturanDocument {

    public function __construct($row){
        $this->id = $row->id();
        // Core Data
        $this->content = $row->data()['content'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // content
    public String $content;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}