<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ApiController extends Controller
{
    public function getFileUploads()
    {
        // 0341492411_prof.wma
        $real = '0341492411_prof.wma';
        $filePath = 'http://ccaretreg5.id/obc_upgradespeed/uploads/recording/'.$real;
        $tempImage = tempnam(sys_get_temp_dir(), $real);
        copy($filePath, $tempImage);
        $data = [
            'status' => 200,
            'message' => 'Success',
            'content' => [
                'file' => base64_encode($filePath),
                'name' => $filePath           
            ]
        ];
        
        return response()->download($tempImage, $real);
    }
}
