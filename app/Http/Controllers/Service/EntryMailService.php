<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\EntryMailInterface;

class EntryMailService implements EntryMailInterface {

    public const DOCUMENT = "entry_mails";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }

    public function index(): mixed{
        $query = $this->firestore->documents();
        $entryMails = [];
        $rows = collect($query->rows());   

        foreach ($rows as $row) {
            $item = [
                'id' => $row->id(),
                // Foreign keys
                'user_id' => $row->data()['user_id'] ?? "",
                // Core Data
                'title' => $row->data()['title'] ?? "",
                'type' => $row->data()['type'] ?? "",
                'status' => $row->data()['status'] ?? "",
                'file_url' => $row->data()['file_url'] ?? "",
                'reject_reason' => $row->data()['reject_reason'] ?? "",
                // General
                'created_at' => $row->data()['created_at'] ?? "",
                'updated_at' => $row->data()['updated_at'] ?? "",
                'deleted_at' => $row->data()['deleted_at'] ?? "-",
            ];
            array_push($entryMails, $item);
        }
        return $entryMails;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $entryMail = [
            'id' => $row->id(),
                // Foreign keys
            'user_id' => $row->data()['user_id'] ?? "",
            // Core Data
            'title' => $row->data()['title'] ?? "",
            'type' => $row->data()['type'] ?? "",
            'status' => $row->data()['status'] ?? "",
            'file_url' => $row->data()['file_url'] ?? "",
            'reject_reason' => $row->data()['reject_reason'] ?? "",
            // General
            'created_at' => $row->data()['created_at'] ?? "",
            'updated_at' => $row->data()['updated_at'] ?? "",
            'deleted_at' => $row->data()['deleted_at'] ?? "-",
        ];

        return $entryMail;
    }

    // Will be experimenting on old service rahter than new
    public function store($data){
        $query = $this->firestore->newDocument()->set($data);        
    }

    // Will be experimenting on old service rahter than new
    public function update(string $id, $data){
        $query = $this->firestore->document($id)->set($data);        
    }

    // Will be experimenting on old service rahter than new
    public function delete(string $id){
        $query = $this->firestore->document($id)->delete();
    }
}