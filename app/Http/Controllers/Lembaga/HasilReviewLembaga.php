<?php

namespace App\Http\Controllers\Lembaga;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\DokumenAkreditasiModel;
use App\Models\Admin\SebaranBorangModel;
use App\Models\Admin\NilaiMonitoringModel;

class HasilReviewLembaga extends Controller
{
    public function index(Request $request){

        $user = $request->user();
        $data_pengajuan = DokumenAkreditasiModel::where('create_by', '=', $user->nama_lembaga)->get();

        return Inertia::render('Lembaga/HasilReviewLembaga', [
            'data_pengajuan' => $data_pengajuan
        ]);
    }

    public function cekReview($id_pengajuan){
        $data_review = NilaiMonitoringModel::
        join('tb_pengajuan_akreditasi', 'tb_pengajuan_akreditasi.id_pengajuan', '=', 'tb_nilai_monitoring.id_pengajuan')

        ->join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_pengajuan_akreditasi.id_lembaga_akreditasi')
        
        ->join('tb_lembaga_unuja', 'tb_lembaga_unuja.id_lembaga', '=', 'tb_pengajuan_akreditasi.id_lembaga')
        
        ->where('tb_nilai_monitoring.id_pengajuan', '=', $id_pengajuan)
        
        ->get([
            'tb_nilai_monitoring.*',
            'tb_lembaga_akreditasi.nama_lembaga as akreditasi',
            'tb_lembaga_unuja.nama_lembaga as lembaga',
        ]);

        return Inertia::render('Lembaga/DetailReviewLembaga', [
            // dd($data_review)
            'data_review' => $data_review
        ]);
    }
}
