<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;


// Service
use App\Http\Controllers\Service\PengumumanService;

class PengumumanController extends Controller
{
    use ResponseTrait;
    use CommonTrait;

    protected PengumumanService $pengumumanService;

    public const DOCUMENT = "announcements";
    public const STORAGE = "announcements/";

    public function __construct(){
        $this->pengumumanService = new PengumumanService();
    }
    
    public function index(){
        $announcements = $this->pengumumanService->index();
        return $this->successResponse("success fetching resources", $announcements);
    }

    public function show(String $id){
        $announcement = $this->pengumumanService->getById($id);
        return $this->successResponse("success fetching resources", $announcement);
    }

    public function store(Request $request){
        if ($request->file('image')) {
            $urlPath = $this->storeImage($request->file('image'), static::STORAGE);
        }

        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'image_url' => $urlPath ?? "",
        ];
        $this->pengumumanService->store($data);

        return $this->successResponse("success created resources", null);
    }

    public function update(Request $request, String $id){
        $row = $this->pengumumanService->getById($id);
        
        $data = [
            'title' => $request->post('title') ? $request->post('title') : $row->data()['title'] ?? "",
            'content' => $request->post('content') ? $request->post('content') : $row->data()['content'] ?? "",
        ];

        // If the user uploading an image
        // This is bug
        // if ($request->file('image')) {
        //     $data['image_url'] = $this->storeImage($request->file('image'), static::STORAGE);
        // } else {
        //     $data['image_url'] = $row->data()['image_url'] ?? "";
        // }

        $this->pengumumanService->update($id, $data);

        return $this->successResponse("success update resuource", null);
    }

    public function destroy(String $id){
        $id = $this->pengumumanService->index()[0]->id;
        $this->pengumumanService->delete($id);
        
        return $this->successResponse("success delete resuource", null);
    }
}