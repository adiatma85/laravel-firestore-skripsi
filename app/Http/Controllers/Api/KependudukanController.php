<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\FamilyService;
use App\Http\Controllers\Service\KependudukanService;
use App\Http\Controllers\Service\UserService;
use App\Http\Controllers\Contracts\KependudukanInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

// Fokus pada handle kependudukan terlebih dahulu
class KependudukanController extends Controller{
    use ResponseTrait;
    use CommonTrait;

    protected KependudukanInterface $kependudukanService;
    protected UserService $userService;
    protected FamilyService $familyService;

    public function __construct(){
        $this->kependudukanService = new KependudukanService();
    }

    public function index(){
        $kependudukans = $this->kependudukanService->index();
        return $this->successResponse("success fetching resources", $kependudukans);
    }

    public function show(String $id){
        $kependudukan = $this->kependudukanService->getById($id);
        return $this->successResponse("success fetching resources", $kependudukan);
    }

    public function store(Request $request){
        $data = [
            "fullname"=> $request->post('fullname') ?? "",
            "nik" => $request->post('nik') ?? "",
            "birthdate" => $request->post('birthdate') ?? "",
            "birthplace" => $request->post('birthplace') ?? "",
            "gender" => $request->post('gender') ?? "",
            "religion" => $request->post('religion') ?? "",
            "marital_status" => $request->post('marital_status') ?? "",
            "latest_education" => $request->post('latest_education') ?? "",
            "occupation" => $request->post('occupation') ?? "",
            "father_name" => $request->post('father_name') ?? "",
            "father_occupation" => $request->post('father_occupation') ?? "",
            "father_religion" => $request->post('father_religion') ?? "",
            "mother_name" => $request->post('mother_name') ?? "",
            "mother_occupation" => $request->post('mother_occupation') ?? "",
            "mother_religion" => $request->post('mother_religion') ?? "",
            "disease" => $request->post('disease') ?? "",
        ];
        $this->kependudukanService->store($data);

        return $this->successResponse("success created resources", null);
    }

    public function update(Request $request, String $id){
        $row = $this->kependudukanService->getById($id);

        $data = [
            "fullname"=> $request->post('fullname') ? $request->post('fullname') : $row->data()['fullname'] ?? "",
            "nik" => $request->post('nik') ? $request->post('nik') : $row->data()['nik'] ?? "",
            "birthdate" => $request->post('birthdate') ? $request->post('birthdate') : $row->data()['birthdate'] ?? "",
            "birthplace" => $request->post('birthplace') ? $request->post('birthplace') : $row->data()['birthplace'] ?? "",
            "gender" => $request->post('gender') ? $request->post('gender') : $row->data()['gender'] ?? "",
            "religion" => $request->post('religion') ? $request->post('religion') : $row->data()['religion'] ?? "",
            "marital_status" => $request->post('marital_status') ? $request->post('marital_status') : $row->data()['marital_status'] ?? "",
            "latest_education" => $request->post('latest_education') ? $request->post('latest_education') : $row->data()['latest_education'] ?? "",
            "occupation" => $request->post('occupation') ? $request->post('occupation') : $row->data()['occupation'] ?? "",
            "father_name" => $request->post('father_name') ? $request->post('father_name') : $row->data()['father_name'] ?? "",
            "father_occupation" => $request->post('father_occupation') ? $request->post('father_occupation') : $row->data()['father_occupation'] ?? "",
            "father_religion" => $request->post('father_religion') ? $request->post('father_religion') : $row->data()['father_religion'] ?? "",
            "mother_name" => $request->post('mother_name') ? $request->post('mother_name') : $row->data()['mother_name'] ?? "",
            "mother_occupation" => $request->post('mother_occupation') ? $request->post('mother_occupation') : $row->data()['mother_occupation'] ?? "",
            "mother_religion" => $request->post('mother_religion') ? $request->post('mother_religion') : $row->data()['mother_religion'] ?? "",
            "disease" => $request->post('disease') ? $request->post('disease') : $row->data()['disease'] ?? "",
        ];

        $this->kependudukanService->update($id, $data);

        return $this->successResponse("success update resuource", null);
    }

    public function destroy(String $id){
        $id = $this->kependudukanService->index()[0]->id;
        $this->kependudukanService->delete($id);
        
        return $this->successResponse("success delete resuource", null);
    }
}