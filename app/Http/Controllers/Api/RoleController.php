<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\RoleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

class RoleController extends Controller{

    use ResponseTrait;
    use CommonTrait;

    protected RoleService $roleService;

    public const DOCUMENT = "roles";
    public const STORAGE = "roles/";

    public function __construct(){
        $this->roleService = new RoleService();
    }

    public function index(){
        $rules = $this->roleService->index();
        return $this->successResponse("success fetching resources", $rules);
    }

    public function show(String $id){
        $rule = $this->roleService->getById($id);
        return $this->successResponse("success fetching response", $rule);
    }

    public function store(Request $request){
        $data = [
            'title' => $request->post('title'),
        ];
        $this->roleService->store($data);

        return $this->successResponse("success created resource", null);
    }

    public function update(Request $request, String $id){
        $row = $this->roleService->getById($id);

        $data = [
            'title' => $request->post('title') ? $request->post('title') : $row->data()['title'] ?? "",
        ];

        $this->roleService->update($id, $data);

        return $this->successResponse("success update resource", null);
    }

    public function destroy(String $id){
        $id = $this->beritaService->index()[0]['id'];
        $this->roleService->delete($id);

        return $this->successResponse("success delete resuource", null);
    }
}