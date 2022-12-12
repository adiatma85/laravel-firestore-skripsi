<?php

namespace App\Documents;

class KependudukanDocument {

    public function __construct($row){
        $this->id = $row->id();
        // foreign
        $this->user_id = $row->data()['user_id'] ?? "";
        $this->family_id = $row->data()['family_id'] ?? "";
        // Core Data
        $this->nik = $row->data()['nik'] ?? "";
        $this->birthdate = $row->data()['birthdate'] ?? "";
        $this->birthplace = $row->data()['birthplace'] ?? "";
        $this->address = $row->data()['address'] ?? "";
        $this->gender = $row->data()['gender'] ?? "";
        $this->religion = $row->data()['religion'] ?? "";
        $this->marital_status = $row->data()['marital_status'] ?? "";
        $this->latest_education = $row->data()['latest_education'] ?? "";
        $this->occupation = $row->data()['occupation'] ?? "";
        $this->phone_number = $row->data()['phone_number'] ?? "";
        $this->disease = $row->data()['disease'] ?? "";
        $this->rt_rw = $row->data()['rt_rw'] ?? "";
        $this->kelurahan = $row->data()['kelurahan'] ?? "";
        $this->kecamatan = $row->data()['kecamatan'] ?? "";
        $this->city = $row->data()['city'] ?? "";
        $this->province = $row->data()['province'] ?? "";
        $this->father_name = $row->data()['father_name'] ?? "";
        $this->father_religion = $row->data()['father_religion'] ?? "";
        $this->father_occupation = $row->data()['father_occupation'] ?? "";
        $this->mother_name = $row->data()['mother_name'] ?? "";
        $this->mother_religion = $row->data()['mother_religion'] ?? "";
        $this->mother_occupation = $row->data()['mother_occupation'] ?? "";
        // general Data
        $this->created_at = $row->data()['created_at'] ?? "";
        $this->updated_at = $row->data()['updated_at'] ?? "";
        $this->deleted_at = $row->data()['deleted_at'] ?? "";
    }

    //Id
    public String $id;

    // user_id
    public String $user_id;

    // family_id
    public String $family_id;

    // Nama Lengkap
    public String $fullname;

    // NIK
    public String $nik;

    // Birthdate
    public String $birthdate;

    // Birthplace
    public String $birthplace;

    // Address
    public String $address;

    // Gender
    public String $gender;

    // Religion
    public String $religion;

    // Marital Status
    public String $marital_status;

    // Pendidikan Terakhir
    public String $latest_education;

    // Pekerjaan
    public String $occupation;

    // Phone Number
    public String $phone_number;

    // Riwayat Penyakit
    public String $disease;

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

    // Nama Ayah
    public String $father_name;

    // Agama Ayah
    public String $father_religion;

    // Pekerjaan Ayah
    public String $father_occupation;

    // Nama Ibu
    public String $motherr_name;

    // Agama Ibu
    public String $motherr_religion;

    // Pekerjaan Ibu
    public String $motherr_occupation;

    // Created At
    public String $created_at;

    // Updated At
    public String $updated_at;

    // Deleted At
    public String $deleted_at;
}