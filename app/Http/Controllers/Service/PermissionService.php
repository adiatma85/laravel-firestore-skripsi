<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\PermissionInterface;
use Illuminate\Support\Carbon;

class PermissionService implements PermissionInterface{

    public const DOCUMENT = "permissions";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);   
    }

    public function index(): mixed{
        $query = $this->firestore->documents();
        $permissions = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            $item = [
                'id' => $row->id(),  
                // Core Data
                'title' => $row->data()['title'] ?? "",
                // General
                'created_at' => $row->data()['created_at'] ?? "",
                'updated_at' => $row->data()['updated_at'] ?? "",
                'deleted_at' => $row->data()['deleted_at'] ?? "-",
            ];
            array_push($permissions, $item);
        }

        return $permissions;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $permission = [
            'id' => $row->id(),  
            // Core Data
            'title' => $row->data()['title'] ?? "",
            // General
            'created_at' => $row->data()['created_at'] ?? "",
            'updated_at' => $row->data()['updated_at'] ?? "",
            'deleted_at' => $row->data()['deleted_at'] ?? "-",
        ];

        return $permission;
    }

    public function store($data){
        $data['created_at'] = Carbon::now()->toTimeString();
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->newDocument()->set($data);        
    }

    public function update(string $id, $data){
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->document($id)->set($data);
    }

    public function delete(string $id){
        $query = $this->firestore->document($id)->delete();
    }
}