<?php

namespace App\Http\Controllers\Lp2m;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\DataLkpsModel;
use App\Http\Controllers\Controller;

class MonitoringLkps extends Controller
{
    public function index(){
        $MonitoringLkps = DataLkpsModel::where('status', '=', 'a')->with('lembaga_unuja')->get();

        return Inertia::render('Lp2m/MonitoringLkps', [
            'MonitoringLkps' => $MonitoringLkps
        ]);
    }

    public function getLkps($id_pengajuan_lkps){
        $Nilai = DataLkpsModel::where('id_pengajuan_lkps', '=', $id_pengajuan_lkps)->with('lembaga_unuja')->first();

        return Inertia::render('Lp2m/NilaiMonitoringLkps', [
            'Nilai' => $Nilai
        ]);
    }

    public function nilaiLkps(Request $request, $id_pengajuan_lkps){

        $ubah = DataLkpsModel::find($id_pengajuan_lkps);

        $request->validate([
            'nilai_lkps' => ['required', 'numeric']
        ]);

        $ubah->update([
            'id_lembaga' => $request->id_lembaga,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'tgl_penilaian' => Carbon::now(),
            'patch_dokumen' => $request->patch_dokumen,
            'nilai_lkps' => $request->nilai_lkps,
            'status' => $request->status,
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
        ]);

        return to_route('monitoring-lkps.index')->with('message', 'Berhasil memberikan nilai...');
    }
}
