<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

class PengumumanController extends Controller
{
    use ResponseTrait;
    use CommonTrait;

    public const DOCUMENT = "announcements";
    public const STORAGE = "announcements/";
    
    public function index(){
        $data = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->documents();
            
        $announcements = [];
        $announcementsRow = collect($data->rows());
        foreach ($announcementsRow as $row) {
            $item = [
                'id' => $row->id(),
                'title' => $row->data()['title'] ?? "",
                'content' => $row->data()['content'] ?? "",
                'image_url' => $row->data()['image_url'] ?? "",
            ];
            array_push($announcements, $item);
        }
        return $this->successResponse("success fetching resources", $announcements);
    }

    public function show(String $id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id);

        $row = $firestore->snapshot();
        $announcement = [
            'id' => $row->id(),
            'title' => $row->data()['title'] ?? "",
            'content' => $row->data()['content'] ?? "",
            'image_url' => $row->data()['image_url'] ?? "",
        ];
        
        return $this->successResponse("success fetching resources", $announcement);
    }

    public function store(Request $request){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->newDocument();

        if ($request->file('image')) {
            $urlPath = $this->storeImage($request->file('image'), static::STORAGE);
        }
        
        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'image_url' => $urlPath ?? "",
        ];
        $firestore->set($data);

        return $this->successResponse("success created resources", null);
    }

    public function update(Request $request, String $id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id);
        
        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
        ];

        // If the user uploading an image
        // This is bug
        // if ($request->file('image')) {
        //     $data['image_url'] = $this->storeImage($request->file('image'), static::STORAGE);
        // } else {
        //     $data['image_url'] = $row->data()['image_url'] ?? "";
        // }

        $firestore->set($data);

        return $this->successResponse("success update resuource", null);
    }

    public function destroy(String $id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id)
            ->delete();
        
        return $this->successResponse("success delete resuource", null);
    }
}
