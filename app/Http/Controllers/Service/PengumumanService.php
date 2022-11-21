<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\PengumumanInterface;

class PengumumanService implements PengumumanInterface {

    public const DOCUMENT = "announcements";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }

    public function index(): mixed{
        $query = $this->firestore->documents();
        $announcements = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            $item = [
                'id' => $row->id(),
                'title' => $row->data()['title'] ?? "",
                'content' => $row->data()['content'] ?? "",
                'image_url' => $row->data()['image_url'] ?? "",
            ];
            array_push($announcements, $item);
        }
        return $announcements;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $news = [
            'id' => $row->id(),
            'title' => $row->data()['title'] ?? "",
            'content' => $row->data()['content'] ?? "",
            'image_url' => $row->data()['image_url'] ?? "",
        ];

        return $news;
    }

    public function store($data) {
        $query = $this->firestore->newDocument()->set($data);        
    }

    public function update(string $id, $data) {
        $query = $this->firestore->document($id)->set($data);
    }

    public function delete(string $id){
        $query = $this->firestore->document($id)->delete();
    }
}