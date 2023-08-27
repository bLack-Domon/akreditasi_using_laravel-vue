<?php

namespace App\Http\Controllers\Prodi;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SebaranBorangModel;
use App\Models\Admin\DokumenAkreditasiModel;
use App\Models\Admin\DetailPengajuanAkreditasiModel;

class HasilReviewProdi extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $data_pengajuan = SebaranBorangModel::join('tb_nilai_monitoring', 'tb_nilai_monitoring.id_pengajuan', '=', 'tb_pengajuan_akreditasi.id_pengajuan')->where('tb_pengajuan_akreditasi.create_by', '=', $user->nama_lembaga)->with('lembaga_unuja', 'lembaga_akreditasi')->get(['tb_nilai_monitoring.nilai', 'tb_nilai_monitoring.tgl_penilaian', 'tb_pengajuan_akreditasi.*']);

        return Inertia::render('Kaprodi/HasilReviewProdi', [
            'data_pengajuan' => $data_pengajuan,
            // dd($data_pengajuan)
        ]);
    }


    // public function detail($id_pengajuan){
    //     $data_pengajuan = DetailPengajuanAkreditasiModel::where('id_pengajuan', '=', $id_pengajuan)->get();

    //     return Inertia::render('Kaprodi/DetailHasilReviewProdi', [
    //         // 'data_pengajuan' => $data_pengajuan
    //         dd($data_pengajuan)
    //     ]);
    // }

    // public function cekReview($id_pengajuan){
    //     $data_review = DokumenAkreditasiModel::
    //     join('tb_pengajuan_akreditasi', 'tb_pengajuan_akreditasi.id_pengajuan', '=', 'tb_nilai_monitoring.id_pengajuan')

    //     ->join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_pengajuan_akreditasi.id_lembaga_akreditasi')
        
    //     ->join('tb_lembaga_unuja', 'tb_lembaga_unuja.id_lembaga', '=', 'tb_pengajuan_akreditasi.id_lembaga')
        
    //     ->where('tb_nilai_monitoring.id_pengajuan', '=', $id_pengajuan)
        
    //     ->get([
    //         'tb_nilai_monitoring.*',
    //         'tb_lembaga_akreditasi.nama_lembaga as akreditasi',
    //         'tb_lembaga_unuja.nama_lembaga as lembaga',
    //     ]);

    //     return Inertia::render('Kaprodi/DetailReviewProdi', [
    //         // dd($data_review)
    //         'data_review' => $data_review
    //     ]);
    // }
}
