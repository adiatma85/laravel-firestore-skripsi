<?php

namespace App\Documents;

class EntryMailDocument {

    public function __construct($row){
        $this->id = $row->id();
        // Foreign Data
        $this->user_id = $row->data()['user_id'] ?? "";
        // Core Data
        $this->title = $row->data()['title'] ?? "";
        $this->type = $row->data()['type'] ?? "";
        $this->status = $row->data()['status'] ?? "";
        $this->file_url = $row->data()['file_url'] ?? "";
        $this->reject_reason = $row->data()['reject_reason'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // User id
    public String $user_id;

    // Title
    public String $title;

    // Type
    public String $type;

    // Status
    public String $status;

    // File_url
    public String $file_url;

    // Reject Reason
    public String $reject_reason;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}