<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\DataLkpsModel;
use App\Models\Admin\JenisBabModel;
use App\Http\Controllers\Controller;
use App\Models\Admin\SebaranBorangModel;
use App\Models\Admin\DokumenAkreditasiModel;
use App\Http\Resources\Admin\DokumenResource;
use App\Models\Admin\DetailPengajuanAkreditasiModel;

class DokumenAkreditasi extends Controller
{
    public function detailDokumen($id_detail_pengajuan)
    {
        $list_data = DokumenAkreditasiModel::
        join('tb_detail_pengajuan_akreditasi', 'tb_detail_pengajuan_akreditasi.id_detail_pengajuan', '=', 'tb_dokumen_akreditasi.id_detail_pengajuan')

        ->join('tb_pengajuan_akreditasi', 'tb_pengajuan_akreditasi.id_pengajuan', '=', 'tb_detail_pengajuan_akreditasi.id_pengajuan')
        
        ->join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_pengajuan_akreditasi.id_lembaga_akreditasi')
        
        ->join('tb_lembaga_unuja', 'tb_lembaga_unuja.id_lembaga', '=', 'tb_pengajuan_akreditasi.id_lembaga')
        
        ->where('tb_dokumen_akreditasi.id_detail_pengajuan', '=', $id_detail_pengajuan)
        
        ->get([
            'tb_dokumen_akreditasi.*', 
            'tb_detail_pengajuan_akreditasi.deskripsi_isian', 
            'tb_lembaga_akreditasi.nama_lembaga as akreditasi',
            'tb_lembaga_unuja.nama_lembaga as lembaga',
        ]);


        return Inertia::render('Admin/Detail/DokumenAkreditasi', [
            'list_data' => $list_data,
        ]);
    }

    public function daftarDokumen(){
        $data = DokumenAkreditasiModel::all();

        return Inertia::render('Admin/DaftarDokumen', [
            'data' => $data
        ]);
    }

    public function readDok(){
        $data = DokumenAkreditasiModel::where('akses_dokumen', '=', 'bisa')->get();
        $lkps = DataLkpsModel::where('akses_dokumen', '=', 'bisa')->get();

        return Inertia::render('Kaprodi/ReadDokumen', [
            'data' => $data,
            'lkps' => $lkps,
        ]);
    }


    public function editAkses($id_dokumen){
        $data = DokumenAkreditasiModel::find($id_dokumen);

        return Inertia::render('Kaprodi/AksesDokumen/UbahAksesDokumenAkreditasi', [
            'data' => $data,
        ]);
    }


    public function updateAkses(Request $request, $id_dokumen)
    {
        $ubah = DokumenAkreditasiModel::find($id_dokumen);

        $id_detail_pengajuan = $request->id_detail_pengajuan;
        $ubah_status = $request->akses_dokumen;

        if ($ubah_status == 'bisa') {
            $ubah->update([
                'akses_dokumen' => 'tidak',
                'update_by' => $request->update_by,
            ]);

            return redirect()->to('upload-dokumen-akreditasi/3jy4h6n8m3'.$id_detail_pengajuan.'p0c13x/prodi')->with('message', 'Akses berganti menjadi tidak bisa diakses prodi lain...');
        }else{
            $ubah->update([
                'akses_dokumen' => 'bisa',
                'update_by' => $request->update_by,
            ]);

            return redirect()->to('upload-dokumen-akreditasi/3jy4h6n8m3'.$id_detail_pengajuan.'p0c13x/prodi')->with('message', 'Akses berganti menjadi bisa diakses prodi lain...');
        }
    }
}
