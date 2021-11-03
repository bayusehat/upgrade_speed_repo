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
        $filePath = url(public_path('/assets/'.$real));
        $data = [
            'status' => 200,
            'message' => 'Success',
            'content' => [
                'file' => base64_encode($filePath)            ]
        ];
        
        return response($data);
    }
}
