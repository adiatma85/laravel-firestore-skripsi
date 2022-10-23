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
            $category = [
                'name' => $cat->data()['name'],
            ];
            array_push($categories, $category);
        }
        return response()->json($categories);
        // return view('categories.index', [
        //     'categories' => $categories,
        // ]);
    }

    public function store(Request $request)
    {
    $firestore = app('firebase.firestore')
                    ->database()
                    ->collection('categories')
                    ->newDocument();
    $data = [
        'name' => "Tragedy"
    ];
    $firestore->set($data);
    // Redirect, Success message...
    }
}
