<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\FamilyService;
use App\Http\Controllers\Service\KependudukanService;
use App\Http\Controllers\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Http\Controllers\Traits\CommonTrait;

// Fokus pada handle kependudukan terlebih dahulu
class KependudukanController extends Controller{
    use ResponseTrait;
    use CommonTrait;

    protected KependudukanService $kependudukanService;
    protected UserService $userService;
    protected FamilyService $familyService;

    public function index(){
        $kependudukans = $this->kependudukanService->index();
        return $this->successResponse("success fetching resources", $kependudukans);
    }

    public function show(String $id){
        $kependudukan = $this->kependudukanService->getById($id);
        return $this->successResponse("success fetching resources", $kependudukan);
    }

    public function store(Request $request){
        // Store the family first

        // Store data kependudukan

        // Store pada table users
    }

    public function update(Request $request, String $id){
        // Hanya bisa mengupdate data kependudukan

    }

    public function destroy(String $id){
        // Hanya bisa men-delete satu data kependudukan
    }
}