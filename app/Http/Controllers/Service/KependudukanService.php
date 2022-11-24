<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\KependudukanInterface;

class KependudukanService implements KependudukanInterface {

    public const DOCUMENT = "kependudukans";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }
    
    public function index(): mixed{
        $query = $this->firestore->documents();
        $kependudukans = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            // If using soft delete, then we have if to check condition
            $item = [
                'id' => $row->id(),
                // Foreign keys
                'user_id' => $row->data()['user_id'] ?? "",
                'family_id' => $row->data()['family_id'] ?? "",
                // Core Data
                'fullname' => $row->data()['fullname'] ?? "",
                'nik' => $row->data()['nik'] ?? "",
                'birthdate' => $row->data()['birthdate'] ?? "",
                'birthplace' => $row->data()['birthplace'] ?? "",
                'address' => $row->data()['address'] ?? "",
                'gender' => $row->data()['gender'] ?? "",
                'religion' => $row->data()['religion'] ?? "",
                'marital_status' => $row->data()['marital_status'] ?? "",
                'latest_education' => $row->data()['latest_education'] ?? "",
                'occupation' => $row->data()['occupation'] ?? "",
                'phone_number' => $row->data()['phone_number'] ?? "",
                'disease' => $row->data()['disease'] ?? "",
                'rt_rw' => $row->data()['rt_rw'] ?? "",
                'postal_code' => $row->data()['postal_code'] ?? "",
                'kelurahan' => $row->data()['kelurahan'] ?? "",
                'kecamatan' => $row->data()['kecamatan'] ?? "",
                'city' => $row->data()['city'] ?? "",
                'province' => $row->data()['province'] ?? "",
                // Father section
                'father_name' => $row->data()['father_name'] ?? "",
                'father_religion' => $row->data()['father_religion'] ?? "",
                'father_occupation' => $row->data()['father_occupation'] ?? "",
                // Mother section
                'mother_name' => $row->data()['mother_name'] ?? "",
                'mother_religion' => $row->data()['mother_religion'] ?? "",
                'mother_occupation' => $row->data()['mother_occupation'] ?? "",
                // General
                'created_at' => $row->data()['created_at'] ?? "",
                'updated_at' => $row->data()['updated_at'] ?? "",
                'deleted_at' => $row->data()['deleted_at'] ?? "-",
            ];
            array_push($kependudukans, $item);
        }

        return $kependudukans;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $kependudukan = [
            'id' => $row->id(),
            // Foreign Keys
            'user_id' => $row->data()['user_id'] ?? "",
            'family_id' => $row->data()['family_id'] ?? "",
            // Core Data
            'fullname' => $row->data()['fullname'] ?? "",
            'nik' => $row->data()['nik'] ?? "",
            'birthdate' => $row->data()['birthdate'] ?? "",
            'birthplace' => $row->data()['birthplace'] ?? "",
            'address' => $row->data()['address'] ?? "",
            'gender' => $row->data()['gender'] ?? "",
            'religion' => $row->data()['religion'] ?? "",
            'marital_status' => $row->data()['marital_status'] ?? "",
            'latest_education' => $row->data()['latest_education'] ?? "",
            'occupation' => $row->data()['occupation'] ?? "",
            'phone_number' => $row->data()['phone_number'] ?? "",
            'disease' => $row->data()['disease'] ?? "",
            'rt_rw' => $row->data()['rt_rw'] ?? "",
            'postal_code' => $row->data()['postal_code'] ?? "",
            'kelurahan' => $row->data()['kelurahan'] ?? "",
            'kecamatan' => $row->data()['kecamatan'] ?? "",
            'city' => $row->data()['city'] ?? "",
            'province' => $row->data()['province'] ?? "",
            // Father section
            'father_name' => $row->data()['father_name'] ?? "",
            'father_religion' => $row->data()['father_religion'] ?? "",
            'father_occupation' => $row->data()['father_occupation'] ?? "",
            // Mother section
            'mother_name' => $row->data()['mother_name'] ?? "",
            'mother_religion' => $row->data()['mother_religion'] ?? "",
            'mother_occupation' => $row->data()['mother_occupation'] ?? "",
            // General
            'created_at' => $row->data()['created_at'] ?? "",
            'updated_at' => $row->data()['updated_at'] ?? "",
            'deleted_at' => $row->data()['deleted_at'] ?? "-",
        ];

        return $kependudukan;
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