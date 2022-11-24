<?php


namespace App\Http\Controllers\Service;

// Interface
use App\Http\Controllers\Contracts\UserInterface;
use Illuminate\Support\Carbon;

// Reference for firestore https://googleapis.github.io/google-cloud-php/#/docs/cloud-firestore/v1.26.0/firestore/firestoreclient
    // https://firebase.google.com/docs/firestore/query-data/queries
class UserService implements UserInterface {

    public const DOCUMENT = "users";
    protected $firestore;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);
    }


    // Function to check whether email is exist or not
    // Return boolean
    public function isEmailExist(string $email) : bool{
        $documents = $this->firestore->where('email', '=', $email)->documents();

        // If $documents > 0, always return true
        // Is this bug? Because $document can be implemented on ``foreach`` but can not be counted
        foreach ($documents as $row) {
            return true;
        }

        return false;
    }

    // Store the user
    public function store($data){
        $data['created_at'] = Carbon::now()->toTimeString();
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->newDocument()->set($data);
    }

    // Function to get particular user with email
    public function getByEmail(string $email) : mixed {
        $documents = $this->firestore->where('email', '=', $email)->documents();
        $user = null;

        foreach ($documents as $row) {
            $user = [
                "id" => $row->id(),
                "email" => $row->data()['email'] ?? "",
                "password" => $row->data()["password"] ?? "",
            ];
        }

        return $user;
    }
}