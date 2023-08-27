<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\DataLkpsModel;
use App\Http\Controllers\Controller;

class DataLkps extends Controller
{
    public function index(){
        $data = DataLkpsModel::with('lembaga_unuja')->get();
        return Inertia::render('Admin/DataLkps', [
            'data' => $data
        ]);
    }
}
