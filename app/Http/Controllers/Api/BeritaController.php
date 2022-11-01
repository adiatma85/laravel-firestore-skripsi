<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;

class BeritaController extends Controller
{
    use ResponseTrait;
    public const DOCUMENT = "news";

    public function index(){
        $data = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->documents();
            
        $news = [];
        $newsRow = collect($data->rows());
        foreach ($newsRow as $row) {
            $item = [
                'id' => $row->id(),
                'title' => $row->data()['title'],
                'content' => $row->data()['content'],
            ];
            array_push($news, $item);
        }
        return $this->successResponse("success fetching resources", $news);
    }

    public function show($id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id);

        $row = $firestore->snapshot();
        $news = [
            'id' => $row->id(),
            'title' => $row->data()['title'],
            'content' => $row->data()['content'],
        ];

        return $this->successResponse("success fetching resources", $news);
    }

    public function store(Request $request)
    {
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->newDocument();

        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
        ];
        $firestore->set($data);

        return $this->successResponse("success created resources", null);
    }

    public function update(Request $request, $id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id);
        
        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
        ];
        $firestore->set($data);

        return $this->successResponse("success update resuource", null);
    }

    public function destroy($id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id)
            ->delete();
        
        return $this->successResponse("success delete resuource", null);
    }
}
