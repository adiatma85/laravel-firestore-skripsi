<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\EntryMailInterface;
use Illuminate\Support\Carbon;
use App\Documents\EntryMailDocument;

class EntryMailService implements EntryMailInterface {

    public const DOCUMENT = "entry_mails";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }

    public function index(): mixed{
        $query = $this->firestore->documents();
        $entryMails = [];
        $rows = collect($query->rows());   

        foreach ($rows as $row) {
            $item = new EntryMailDocument($row);
            array_push($entryMails, $item);
        }
        return $entryMails;
    }

    public function getById(string $id): mixed{
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $entryMail = new EntryMailDocument($row);

        return $entryMail;
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