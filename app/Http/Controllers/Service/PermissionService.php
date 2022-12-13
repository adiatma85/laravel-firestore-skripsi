<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\PermissionInterface;
use Illuminate\Support\Carbon;
use App\Documents\PermissionDocument;

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
            $item = new PermissionDocument($row);
            array_push($permissions, $item);
        }

        return $permissions;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $permission = new PermissionDocument($row);

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