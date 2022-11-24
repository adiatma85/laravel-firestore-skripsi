<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\PeraturanService;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

class PeraturanController extends Controller{

    use ResponseTrait;
    use CommonTrait;

    protected PeraturanService $peraturanService;

    public const DOCUMENT = "rules";
    public const STORAGE = "rules/";

    public function __construct(){
        $this->peraturanService = new PeraturanService();
    }

    public function index(){
        $rules = $this->peraturanService->index();
        return $this->successResponse("success fetching resources", $rules);
    }

    public function show(String $id){
        $rule = $this->peraturanService->getById($id);
        return $this->successResponse("success fetching response", $rule);
    }

    public function store(Request $request){
        $data = [
            'content' => $request->post('content'),
        ];
        $this->peraturanService->store($data);

        return $this->successResponse("success created resource", null);
    }

    public function update(Request $request, String $id){
        $row = $this->peraturanService->getById($id);

        $data = [
            'content' => $request->post('content') ? $request->post('content') : $row->data()['content'] ?? "",
        ];

        $this->peraturanService->update($id, $data);

        return $this->successResponse("success update resource", null);
    }

    public function destroy(String $id){
        $this->peraturanService->delete($id);

        return $this->successResponse("success delete resuource", null);
    }
}