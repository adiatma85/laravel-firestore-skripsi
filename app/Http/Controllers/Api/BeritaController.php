<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

// Contracts
use App\Http\Controllers\Contracts\BeritaInterface;

// Service
use App\Http\Controllers\Service\BeritaService;

class BeritaController extends Controller
{
    use ResponseTrait;
    use CommonTrait;

    protected BeritaInterface $beritaService;

    public const DOCUMENT = "news";
    public const STORAGE = "news/";

    public function __construct(){
        $this->beritaService = new BeritaService();
    }

    public function index(){
        $news = $this->beritaService->index();
        return $this->successResponse("success fetching resources", $news);
    }

    // Take note untuk response seperti not found
    public function show($id){
        $news = $this->beritaService->getById($id);
        return $this->successResponse("success fetching resources", $news);
    }

    public function store(Request $request)
    {
        if ($request->file('image')) {
            $urlPath = $this->storeImage($request->file('image'), static::STORAGE);
        }

        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'image_url' => $urlPath ?? "",
        ];
        $this->beritaService->store($data);

        return $this->successResponse("success created resources", null);
    }

    public function update(Request $request, $id){
        $row = $this->beritaService->getById($id);
        
        $data = [
            'title' => $request->post('title') ? $request->post('title') : $row->data()['title'] ?? "",
            'content' => $request->post('content') ? $request->post('content') : $row->data()['content'] ?? "",
        ];

        $this->beritaService->update($id, $data);

        // If the user uploading an image
        // This is bug
        // if ($request->file('image')) {
        //     $data['image_url'] = $this->storeImage($request->file('image'), static::STORAGE);
        // } else {
        //     $data['image_url'] = $row->data()['image_url'] ?? "";
        // }

        return $this->successResponse("success update resuource", null);
    }

    public function destroy($id){
        $id = $this->beritaService->index()[0]['id'];
        $this->beritaService->delete($id);
        
        return $this->successResponse("success delete resuource", null);
    }
}
