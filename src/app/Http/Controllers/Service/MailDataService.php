<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\MailDataInterface;
use Illuminate\Http\Request;

class MailDataService implements MailDataInterface{
    public function index(): mixed{
        
    }

    public function getById(string $id): mixed
    {
        
    }

    public function store($data)
    {
        
    }

    // Ini perlu ada beberapa handle untuk tiap macam surat!!

    public function update(string $id, $data)
    {
        
    }

    public function delete(string $id)
    {
        
    }

    // Special case

    public function generateSuratDomisiliType(Request $request){
        
    }

    public function generateSuratKeteranganBelumMenikahType(Request $request){
        
    }

    public function generateSuratPengantarNikah(Request $request){
        
    }

    public function generateSuratPersetujuanTetangga(Request $request){
        
    }

}