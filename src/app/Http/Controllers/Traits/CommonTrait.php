<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;

trait CommonTrait
{
    // Generate file name from date now
    public function generateFilenameFromDate(String $extension) : String{
        $now = Carbon::now()->format('d-m-Y');
        $randomString = $this->generateRandomString(5);

        $filename = $now . "-" . $randomString . "." . $extension;

        return $filename;
    }

    // Generate random string by given the length of string
    public function generateRandomString(int $n) : String {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Store image with given dir and name
    public function storeImage(UploadedFile $image, String $dirname) : String{
        $extension = $image->getClientOriginalExtension();
        $filename = $this->generateFilenameFromDate($extension);
        
        if (Storage::putFileAs("public/" . $dirname, $image, $filename)){
            $urlPath = $dirname . $filename;
            return URL::asset('storage/' . $urlPath);
        } else {
            return "";
        }
    }
}