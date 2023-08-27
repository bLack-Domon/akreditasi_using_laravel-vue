<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PdfController extends Controller
{
    public function index(){
        $path = Storage::url('dokumenku/l0DFJWf7ncjzxKSHAWR9n2IvSLFNTCLqlEJ01BRt.pdf');

        return $path;
    }
}
