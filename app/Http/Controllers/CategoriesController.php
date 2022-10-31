<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
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
            // return response()->json($cat->data());
            $category = [
                'id' => $cat->id(),
                'name' => $cat->data()['name'],
            ];
            array_push($categories, $category);
        }
        return response()->json($categories);
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
        // Redirect, Success message...

        // return response()->json();
    }

    public function edit(Request $request, $id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection('categories')
            ->document($id);
        
        $data = [
            'name' => $request->post('name'),
        ];

        $firestore->set($data);

        // Return the appropriate response
    }

    public function delete($id){
        $firestore = app('firebase.firestore')
            ->database()
            ->collection('categories')
            ->document($id)
            ->delete();

        // Return the appropriate response
    }
}
