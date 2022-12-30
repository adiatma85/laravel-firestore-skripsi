<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\EntryMailService;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

class EntryMailController extends Controller {

    use ResponseTrait;
    use CommonTrait;

    protected EntryMailService $entryMailService;

    public const DOCUMENT = "entry_mails";
    public const STORAGE = "entry_mails/";

    public function __construct(){
        $this->entryMailService = new EntryMailService;
    }

    public function index(){
        $rules = $this->entryMailService->index();
        return $this->successResponse("success fetching resources", $rules);
    }

    public function show(String $id){
        $rule = $this->entryMailService->getById($id);
        return $this->successResponse("success fetching response", $rule);
    }

    public function store(Request $request){
        $data = [
            'user_id' => $request->post('user_id'),
            'title' => $request->post('title'),
            'type' => $request->post('type'),
            'status' => $request->post('status'),
            'file_url' => $request->post('file_url'),
            'reject_reason' => $request->post('reject_reason'),
        ];
        $this->entryMailService->store($data);

        return $this->successResponse("success created resource", null);
    }

    public function update(Request $request, String $id){
        $row = $this->entryMailService->getById($id);

        $data = [
            'user_id' => $request->post('user_id') ? $request->post('user_id') : $row->data()['user_id'] ?? "",
            'title' => $request->post('title') ? $request->post('title') : $row->data()['title'] ?? "",
            'type' => $request->post('type') ? $request->post('type') : $row->data()['type'] ?? "",
            'status' => $request->post('status') ? $request->post('status') : $row->data()['status'] ?? "",
            'file_url' => $request->post('file_url') ? $request->post('file_url') : $row->data()['file_url'] ?? "",
            'reject_reason' => $request->post('reject_reason') ? $request->post('reject_reason') : $row->data()['reject_reason'] ?? "",
        ];

        $this->entryMailService->update($id, $data);

        return $this->successResponse("success update resource", null);
    }

    public function destroy(String $id){
        $id = $this->entryMailService->index()[0]->id;
        $this->entryMailService->delete($id);

        return $this->successResponse("success delete resuource", null);
    }
}