<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\BeritaInterface;
use Illuminate\Support\Carbon;

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
            $item = [
                'id' => $row->id(),
                // Core Data
                'title' => $row->data()['title'] ?? "",
                'content' => $row->data()['content'] ?? "",
                'image_url' => $row->data()['image_url'] ?? "",
                // General
                'created_at' => $row->data()['created_at'] ?? "",
                'updated_at' => $row->data()['updated_at'] ?? "",
                'deleted_at' => $row->data()['deleted_at'] ?? "-",
            ];
            array_push($news, $item);
        }
        return $news;
    }

    public function getById(string $id): mixed {
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $news = [
            'id' => $row->id(),
            'title' => $row->data()['title'] ?? "",
            'content' => $row->data()['content'] ?? "",
            'image_url' => $row->data()['image_url'] ?? "",
            // General
            'created_at' => $row->data()['created_at'] ?? "",
            'updated_at' => $row->data()['updated_at'] ?? "",
            'deleted_at' => $row->data()['deleted_at'] ?? "-",
        ];

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