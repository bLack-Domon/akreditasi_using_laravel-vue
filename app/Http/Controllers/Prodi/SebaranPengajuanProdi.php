<?php

namespace App\Http\Controllers\Prodi;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SebaranPengajuanProdi extends Controller
{
    public function index(){
        return Inertia::render('Kaprodi/SebaranPengajuanProdi');
    }
}
