<?php

namespace App\Http\Controllers\Service;

use App\Documents\FamilyDocument;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Contracts\FamilyInterface;

class FamilyService implements FamilyInterface{

    public const DOCUMENT = "families";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }

    public function index(): mixed{
        $query = $this->firestore->documents();
        $families = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            // If using soft delete, then we have if to check condition
            $item = new FamilyDocument($row);
            array_push($families, $item);
        }

        return $families;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $family = new FamilyDocument($row);

        return $family;
    }

    // Will be experimenting on old service rahter than new
    public function store($data){
        $data['created_at'] = Carbon::now()->toTimeString();
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->newDocument()->set($data);        
    }

    // Will be experimenting on old service rahter than new
    public function update(string $id, $data){
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->document($id)->set($data);        
    }

    // Will be experimenting on old service rahter than new
    public function delete(string $id){
        $query = $this->firestore->document($id)->delete();
    }
}