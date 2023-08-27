<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\NilaiMonitoringModel;

class HasilMonitoring extends Controller
{
    public function index(){

        $data = NilaiMonitoringModel::with('pengajuan_akreditasi')->get();

        return Inertia::render('Admin/HasilMonitoring', [
            'data' => $data
        ]);
    }
}