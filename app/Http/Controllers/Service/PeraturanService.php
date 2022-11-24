<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\PeraturanInterface;
use Illuminate\Support\Carbon;

class PeraturanService implements PeraturanInterface{

    public const DOCUMENT = "rules";
    protected $firestore;
    
    public function index(): mixed{
        $query = $this->firestore->documents();
        $rules = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            $item = [
                'id' => $row->id(),
                // Core Data
                'content' => $row->data()['content'] ?? "",
                // General
                'created_at' => $row->data()['created_at'] ?? "",
                'updated_at' => $row->data()['updated_at'] ?? "",
                'deleted_at' => $row->data()['deleted_at'] ?? "-",
            ];
            array_push($rules, $item);
        }

        return $rules;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $rule = [
            'id' => $row->id(),
            // Core Data
            'content' => $row->data()['content'] ?? "",
            // General
            'created_at' => $row->data()['created_at'] ?? "",
            'updated_at' => $row->data()['updated_at'] ?? "",
            'deleted_at' => $row->data()['deleted_at'] ?? "-",
        ];
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

    // For delete, wait after testing two function above
    public function delete(string $id){
        $query = $this->firestore->document($id)->delete();
    }
}