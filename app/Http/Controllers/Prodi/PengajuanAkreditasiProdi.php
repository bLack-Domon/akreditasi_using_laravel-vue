<?php

namespace App\Http\Controllers\Prodi;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\JenisBabModel;
use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSubBabModel;
use App\Models\Admin\SebaranBorangModel;
use App\Models\Admin\DokumenAkreditasiModel;
use App\Models\Admin\DetailPengajuanAkreditasiModel;

class PengajuanAkreditasiProdi extends Controller
{
    public function index(Request $request)
    {
        $cekUser = $request->user();
        $data = SebaranBorangModel::where('id_lembaga', '=', $cekUser->id_lembaga)->where('status', '=', 'a')->with(['lembaga_unuja', 'lembaga_akreditasi'])->get();

        return Inertia::render('Kaprodi/SebaranBorang', [
            'data' => $data,
        ]);
    }
  
  
    public function detail($id_pengajuan)
    {
        $data = DetailPengajuanAkreditasiModel::where('id_pengajuan', '=', $id_pengajuan)->where('status', '=', 'a')->with(['pengajuan_akreditasi', 'sub_kriteria', 'sub_bab'])->get();


        $pengajuan_akreditasi = SebaranBorangModel::where('id_pengajuan', '=', $id_pengajuan)->with(['lembaga_akreditasi', 'lembaga_unuja'])->first();


        return Inertia::render('Kaprodi/DetailPengajuanAkreditasiProdi', [
            'data' => $data,
            'pengajuan_akreditasi' => $pengajuan_akreditasi,
        ]);
    }
  
  
    public function uploadDokumen($id_detail_pengajuan)
    {
        $list_data = DokumenAkreditasiModel::
        join('tb_detail_pengajuan_akreditasi', 'tb_detail_pengajuan_akreditasi.id_detail_pengajuan', '=', 'tb_dokumen_akreditasi.id_detail_pengajuan')

        ->join('tb_pengajuan_akreditasi', 'tb_pengajuan_akreditasi.id_pengajuan', '=', 'tb_detail_pengajuan_akreditasi.id_pengajuan')
        
        ->join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_pengajuan_akreditasi.id_lembaga_akreditasi')
        
        ->join('tb_lembaga_unuja', 'tb_lembaga_unuja.id_lembaga', '=', 'tb_pengajuan_akreditasi.id_lembaga')
        
        ->where('tb_dokumen_akreditasi.id_detail_pengajuan', '=', $id_detail_pengajuan)
        
        ->get([
            'tb_dokumen_akreditasi.*',
            'tb_pengajuan_akreditasi.id_pengajuan' ,
            'tb_lembaga_akreditasi.nama_lembaga as akreditasi',
            'tb_lembaga_unuja.nama_lembaga as lembaga',
        ]);

        // $detail_pengajuan = DetailPengajuanAkreditasiModel::where('id_detail_pengajuan', '=', $id_detail_pengajuan)->first();

        $detail_pengajuan = DetailPengajuanAkreditasiModel::
            select(
            'tb_detail_pengajuan_akreditasi.id_detail_pengajuan',

            'tb_detail_pengajuan_akreditasi.id_kriteria',

            'tb_pengajuan_akreditasi.id_pengajuan',
            
            'tb_lembaga_akreditasi.nama_lembaga',

            'tb_bab.nama_bab', 'tb_bab.deskripsi_bab',

            'tb_kriteria.nama_kriteria',

            'tb_sub_bab.nama_sub_bab',
        )
            ->leftJoin(
                'tb_dokumen_akreditasi',
                'tb_dokumen_akreditasi.id_detail_pengajuan',
                '=',
                'tb_detail_pengajuan_akreditasi.id_detail_pengajuan'
            )

            ->join(
                'tb_pengajuan_akreditasi',
                'tb_pengajuan_akreditasi.id_pengajuan',
                '=',
                'tb_detail_pengajuan_akreditasi.id_pengajuan'
            )

            ->join(
                'tb_kriteria',
                'tb_kriteria.id_kriteria',
                '=',
                'tb_detail_pengajuan_akreditasi.id_kriteria'
            )

            ->join(
                'tb_sub_kriteria',
                'tb_sub_kriteria.id_kriteria',
                '=',
                'tb_kriteria.id_kriteria',
            )


            ->join(
                'tb_sub_bab',
                'tb_sub_bab.id_sub_bab',
                '=',
                'tb_kriteria.id_sub_bab'
            )

            ->join(
                'tb_bab',
                'tb_bab.id_bab',
                '=',
                'tb_sub_bab.id_bab'
            )

            ->join(
                'tb_lembaga_akreditasi',
                'tb_lembaga_akreditasi.id_lembaga_akreditasi',
                '=',
                'tb_bab.id_lembaga_akreditasi'
            )

            ->where('tb_detail_pengajuan_akreditasi.id_detail_pengajuan', '=', $id_detail_pengajuan)

            ->groupBy(
                'tb_detail_pengajuan_akreditasi.id_detail_pengajuan',

                'tb_detail_pengajuan_akreditasi.id_kriteria',

                'tb_pengajuan_akreditasi.id_pengajuan',

                'tb_kriteria.nama_kriteria',

                'tb_lembaga_akreditasi.nama_lembaga',

                'tb_bab.nama_bab', 'tb_bab.deskripsi_bab',

                'tb_sub_bab.nama_sub_bab',
            )
            ->first();

        return Inertia::render('Kaprodi/DokumenAkreditasiProdi', [
            // dd($detail_pengajuan),
            'detail_pengajuan' => $detail_pengajuan,
            'list_data' => $list_data,
        ]);
    }

    
    public function SimpanDokumen(Request $request)
    {
        $request->validate([
            'nama_dokumen' => ['required'],
            'akses_dokumen' => ['required'],
            'patch_dokumen' => ['required', 'mimes: doc,pdf,docx']
        ]);

        if ($request->hasFile('patch_dokumen')) {
            $dokumen = $request->file('patch_dokumen')->store('dokumenku');

            DokumenAkreditasiModel::create([
                'id_detail_pengajuan' => $request->id_detail_pengajuan,
                'nama_dokumen' => $request->nama_dokumen,
                'akses_dokumen' => $request->akses_dokumen,
                'patch_dokumen' => $dokumen,
                'status' => 'a',
                'create_by' => $request->create_by,
            ]);

            return back()->with('message', 'Data Berhasil ditambahkan');
        }
    }

}
