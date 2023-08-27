<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SebaranBorangModel;
use App\Models\Admin\LembagaAkreditasiModel;
use App\Models\Admin\DetailPengajuanAkreditasiModel;

class DetailPengajuanAkreditasi extends Controller
{
    public function tambahDetailPengajuan(Request $request)
    {
        $request->validate([
            'id_kriteria' => ['required'],
            'tgl_pengisian' => ['required'],
        ]);
        
        DetailPengajuanAkreditasiModel::create([
            'id_pengajuan' => $request->id_pengajuan,
            'id_kriteria' => $request->id_kriteria,
            'deskripsi_isian' => $request->deskripsi_isian,
            'tgl_pengisian' => $request->tgl_pengisian,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return back()->with('message', 'Data Berhasil ditambahkan');
    }

    
    public function editStatus($id_detail_pengajuan)
    {
        $data = DetailPengajuanAkreditasiModel::find($id_detail_pengajuan);

        $lembaga_akreditasi = LembagaAkreditasiModel::all();
        $lembaga_unuja = User::where('status_akun', '<>', 'admin')->get();
        return Inertia::render('Admin/Edit/Status/EditStatusPengajuanAkreditasi', [
            'data' => $data,
            'lembaga_akreditasi' => $lembaga_akreditasi,
            'lembaga_unuja' => $lembaga_unuja,
        ]);
    }

    public function updateStatus(Request $request, $id_pengajuan)
    {
        $ubah = SebaranBorangModel::find($id_pengajuan);

        $ubah_status = $request->status;

        if ($ubah_status == 'a') {
            $ubah->update([
                'id_lembaga' => $request->id_lembaga,
                'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'status' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('pengajuan-akreditasi.index')->with('message', 'Status berganti menjadi tidak aktif...');
        } else {
            $ubah->update([
                'id_lembaga' => $request->id_lembaga,
                'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'status' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('pengajuan-akreditasi.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }
}
