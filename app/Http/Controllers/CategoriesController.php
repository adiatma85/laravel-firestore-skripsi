<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    use ResponseTrait;

    public function index(){
        $data = app('firebase.firestore')
            ->database()
            ->collection('categories')
            ->documents();

        if ($data->isEmpty()) {
            return collect();
        }

        $categoriesRow = collect($data->rows());
        $categories = [];
        foreach ($categoriesRow as $cat) {
            $category = [
                'id' => $cat->id(),
                'name' => $cat->data()['name'],
            ];
            array_push($categories, $category);
        }
        return $this->successResponse("success fetching resources", $categories);
    }

    public function show($id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection('categories')
            ->document($id);
        $data = $firestore->snapshot();
        $category = [
            'id' => $data->id(),
            'name' => $data->data()['name'],
        ];
        return $this->successResponse("success fetching resources", $category);
    }

    public function store(Request $request)
    {
        $firestore = app('firebase.firestore')
            ->database()
            ->collection('categories')
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
            ->collection('categories')
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
            ->collection('categories')
            ->document($id)
            ->delete();
        
            return $this->successResponse("success delete resuource", null);
    }
}
