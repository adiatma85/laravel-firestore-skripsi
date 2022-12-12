<?php

namespace App\Documents;

class BeritaDocument {

    public function __construct($row){
        $this->id = $row->id();
        // Core Data
        $this->title = $row->data()['title'] ?? "";
        $this->content = $row->data()['content'] ?? "";
        $this->image_url = $row->data()['image_url'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // Title
    public String $title;

    // Content
    public String $content;

    // Image url
    public String $image_url;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}