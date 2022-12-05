<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\PermissionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;


class PermissionController extends Controller {

    use ResponseTrait;
    use CommonTrait;

    protected PermissionService $permissionService;

    public const DOCUMENT = "permissions";
    public const STORAGE = "permissions/";

    public function __construct(){
        $this->permissionService = new PermissionService();
    }

    public function index(){
        $rules = $this->permissionService->index();
        return $this->successResponse("success fetching resources", $rules);
    }

    public function show(String $id){
        $rule = $this->permissionService->getById($id);
        return $this->successResponse("success fetching response", $rule);
    }

    public function store(Request $request){
        $data = [
            'title' => $request->post('title'),
        ];
        $this->permissionService->store($data);

        return $this->successResponse("success created resource", null);
    }

    public function update(Request $request, String $id){
        $row = $this->permissionService->getById($id);

        $data = [
            'title' => $request->post('title') ? $request->post('title') : $row->data()['title'] ?? "",
        ];

        $this->permissionService->update($id, $data);

        return $this->successResponse("success update resource", null);
    }

    public function destroy(String $id){
        $id = $this->beritaService->index()[0]['id'];
        $this->permissionService->delete($id);

        return $this->successResponse("success delete resuource", null);
    }
}