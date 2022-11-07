<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    use ResponseTrait;
    use CommonTrait;

    public const DOCUMENT = "categories";
    public const STORAGE = "categories/";

    public function index(){
        $data = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->documents();
            
        $categories = [];
        $categoriesRow = collect($data->rows());
        foreach ($categoriesRow as $row) {
            $category = [
                'id' => $row->id(),
                'name' => $row->data()['name'] ?? "",
                'image_url' => $row->data()['image_url'] ?? "",
            ];
            array_push($categories, $category);
        }
        return $this->successResponse("success fetching resources", $categories);
    }

    public function show(String $id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id);
        $row = $firestore->snapshot();

        $category = [
            'id' => $row->id(),
            'name' => $row->data()['name'] ?? "",
            'image_url' => $row->data()['image_url'] ?? "",
        ];

        return $this->successResponse("success fetching resources", $category);
    }

    public function store(Request $request)
    {
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->newDocument();

        if ($request->file('image')) {
            $urlPath = $this->storeImage($request->file('image'), static::STORAGE);
        }

        $data = [
            'name' => $request->post('name'),
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
        $row = $firestore->snapshot();

        $data = [
            'name' => $request->post('name') ? $request->post('name') : $row->data()['name'] ?? "",
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
