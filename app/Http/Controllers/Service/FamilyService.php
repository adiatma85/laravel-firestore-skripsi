<?php

namespace App\Http\Controllers\Service;

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
            $item = [
                'id' => $row->id(),
                // Core Data
                'no_kk' => $row->data()['no_kk'] ?? "",
                'status_kependudukan' => $row->data()['status_kependudukan'] ?? "",
                'address' => $row->data()['address'] ?? "",
                'rt_rw' => $row->data()['rt_rw'] ?? "",
                'postal_code' => $row->data()['postal_code'] ?? "",
                'kelurahan' => $row->data()['kelurahan'] ?? "",
                'kecamatan' => $row->data()['kecamatan'] ?? "",
                'city' => $row->data()['city'] ?? "",
                'province' => $row->data()['province'] ?? "",
                // General
                'created_at' => $row->data()['created_at'] ?? "",
                'updated_at' => $row->data()['updated_at'] ?? "",
                'deleted_at' => $row->data()['deleted_at'] ?? "-",
            ];
            array_push($families, $item);
        }

        return $families;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $family = [
            'id' => $row->id(),
                // Core Data
            'no_kk' => $row->data()['no_kk'] ?? "",
            'status_kependudukan' => $row->data()['status_kependudukan'] ?? "",
            'address' => $row->data()['address'] ?? "",
            'rt_rw' => $row->data()['rt_rw'] ?? "",
            'postal_code' => $row->data()['postal_code'] ?? "",
            'kelurahan' => $row->data()['kelurahan'] ?? "",
            'kecamatan' => $row->data()['kecamatan'] ?? "",
            'city' => $row->data()['city'] ?? "",
            'province' => $row->data()['province'] ?? "",
            // General
            'created_at' => $row->data()['created_at'] ?? "",
            'updated_at' => $row->data()['updated_at'] ?? "",
            'deleted_at' => $row->data()['deleted_at'] ?? "-",
        ];

        return $family;
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