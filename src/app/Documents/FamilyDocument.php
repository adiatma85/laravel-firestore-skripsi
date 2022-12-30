<?php

namespace App\Documents;

class FamilyDocument {

    public function __construct($row){
        $this->id = $row->id();
        // Core Data
        $this->no_kk = $row->data()['no_kk'] ?? "";
        $this->status_kependudukan = $row->data()['status_kependudukan'] ?? "";
        $this->address = $row->data()['address'] ?? "";
        $this->rt_rw = $row->data()['rt_rw'] ?? "";
        $this->kelurahan = $row->data()['kelurahan'] ?? "";
        $this->kecamatan = $row->data()['kecamatan'] ?? "";
        $this->city = $row->data()['city'] ?? "";
        $this->province = $row->data()['province'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // Nomor Kartu Keluarga
    public String $no_kk;

    // Status Kependudukan
    public String $status_kependudukan;

    // Address
    public String $address;

    // rt_rw
    public String $rt_rw;

    // Kode pos
    public String $postal_code;

    // Kelurahan
    public String $kelurahan;

    // Kecamatan
    public String $kecamatan;

    // City
    public String $city;

    // Province
    public String $province;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}