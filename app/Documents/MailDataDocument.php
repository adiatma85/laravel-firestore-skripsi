<?php

namespace App\Documents;

class MailDataDocument {

    public function __construct($row){
        $this->id = $row->id();
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }
}