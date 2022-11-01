<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    use ResponseTrait;
    public const DOCUMENT = "categories";

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
                'name' => $row->data()['name'],
            ];
            array_push($categories, $category);
        }
        return $this->successResponse("success fetching resources", $categories);
    }

    public function show($id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->document($id);
        $row = $firestore->snapshot();

        $category = [
            'id' => $row->id(),
            'name' => $row->data()['name'],
        ];

        return $this->successResponse("success fetching resources", $category);
    }

    public function store(Request $request)
    {
        $firestore = app('firebase.firestore')
            ->database()
            ->collection(static::DOCUMENT)
            ->newDocument();

        $data = [
            'name' => $request->post('name'),
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
            'name' => $request->post('name'),
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
