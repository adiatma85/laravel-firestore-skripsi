<?php

namespace App\Http\Controllers\Contracts;

use Illuminate\Http\Request;

interface MailDataInterface {
    // Function to get All
    public function index() : mixed;

    // Function to get by id
    public function getById(string $id) : mixed;

    // Function to store the data
    public function store($data);

    // Function to update
    public function update(string $id, $data);

    // Function to delete
    public function delete(string $id);

    // Special case function goes below

    // Will return payload to generateSuratDomisili
    public function generateSuratDomisiliType(Request $request);

    // Will return payload to generateSuratKeteranganBelumMenikah
    public function generateSuratKeteranganBelumMenikahType(Request $request);

    // Will return payload to generateSuratPengantarNikah
    public function generateSuratPengantarNikah(Request $request);

    // Will return payload to generateSuratPersetujuanTetangga
    public function generateSuratPersetujuanTetangga(Request $request);
}