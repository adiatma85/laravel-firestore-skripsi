<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\KependudukanInterface;
use Illuminate\Support\Carbon;
use App\Documents\KependudukanDocument;

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
            $item = new KependudukanDocument($row);
            array_push($kependudukans, $item);
        }

        return $kependudukans;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $kependudukan = new KependudukanDocument($row);

        return $kependudukan;
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