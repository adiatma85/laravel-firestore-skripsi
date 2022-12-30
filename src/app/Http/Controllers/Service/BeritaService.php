<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\BeritaInterface;
use Illuminate\Support\Carbon;
use App\Documents\BeritaDocument;

class BeritaService implements BeritaInterface {

    public const DOCUMENT = "news";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }
    
    public function index() : mixed{
        $query = $this->firestore->documents();
        $news = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            $item = new BeritaDocument($row);
            array_push($news, $item);
        }
        return $news;
    }

    public function getById(string $id): mixed {
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $news = new BeritaDocument($row);

        return $news;
    }

    public function store($data) {
        $data['created_at'] = Carbon::now()->toTimeString();
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->newDocument()->set($data);        
    }

    public function update(string $id, $data) {
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->document($id)->set($data);
    }

    // For delete, wait after testing two function above
    public function delete(string $id){
        $query = $this->firestore->document($id)->delete();
    }
}