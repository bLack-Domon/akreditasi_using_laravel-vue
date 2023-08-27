<?php

namespace App\Http\Controllers\Lp2m;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\SebaranBorangModel;
use App\Models\Admin\NilaiMonitoringModel;
use App\Models\Admin\DokumenAkreditasiModel;
use App\Models\Admin\DetailPengajuanAkreditasiModel;

class MonitoringLed extends Controller
{
    public function index()
    {
        $d_pengajuan = SebaranBorangModel::leftJoin('tb_nilai_monitoring', 'tb_nilai_monitoring.id_pengajuan', '=', 'tb_pengajuan_akreditasi.id_pengajuan')
        ->where('tb_pengajuan_akreditasi.status', '=', 'a')
        ->with('lembaga_unuja', 'lembaga_akreditasi')
        ->get(['tb_pengajuan_akreditasi.*', 'tb_nilai_monitoring.nilai']);

        return Inertia::render('Lp2m/MonitoringLed', [
            // dd($d_pengajuan),
            'data_pengajuan' => $d_pengajuan,
        ]);
    }

    public function detail($id_pengajuan)
    {
        $data = DetailPengajuanAkreditasiModel::
            select(
            'tb_detail_pengajuan_akreditasi.id_detail_pengajuan',
            'tb_detail_pengajuan_akreditasi.id_kriteria',
            'tb_pengajuan_akreditasi.id_pengajuan',
            'tb_kriteria.nama_kriteria',
            'tb_lembaga_akreditasi.nama_lembaga',
            'tb_bab.nama_bab',
            'tb_sub_bab.nama_sub_bab',

            DB::raw('COUNT(tb_dokumen_akreditasi.id_dokumen) AS TotalDokumen'),
            DB::raw('(SELECT COUNT(id_sub_kriteria) FROM tb_sub_kriteria WHERE tb_kriteria.id_kriteria = tb_sub_kriteria.id_kriteria) AS TotalSubKriteria')
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

            ->leftJoin(
                'tb_kriteria',
                'tb_kriteria.id_kriteria',
                '=',
                'tb_detail_pengajuan_akreditasi.id_kriteria'
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

            ->where('tb_detail_pengajuan_akreditasi.id_pengajuan', '=', $id_pengajuan)

            ->groupBy(
                'tb_detail_pengajuan_akreditasi.id_detail_pengajuan',
                'tb_detail_pengajuan_akreditasi.id_kriteria',
                'tb_pengajuan_akreditasi.id_pengajuan',
                'tb_kriteria.id_kriteria',
                'tb_kriteria.nama_kriteria',
                'tb_lembaga_akreditasi.nama_lembaga',
                'tb_bab.nama_bab',
                'tb_sub_bab.nama_sub_bab',
            )
            ->get();

        $results = [];

        foreach ($data as $row) {
            $t_Dokumen = $row->TotalDokumen;
            $t_Subkriteria = $row->TotalSubKriteria;
            $percentage = ($t_Dokumen / $t_Subkriteria) * 100;

            $resultRow = (object) [
                'id_detail_pengajuan' => $row->id_detail_pengajuan,
                'id_kriteria' => $row->id_kriteria,
                'id_pengajuan' => $row->id_pengajuan,
                'nama_lembaga' => $row->nama_lembaga,
                'nama_bab' => $row->nama_bab,
                'nama_sub_bab' => $row->nama_sub_bab,
                'nama_kriteria' => $row->nama_kriteria,
                'TotalDokumen' => $t_Dokumen,
                'TotalSubkriteria' => $t_Subkriteria,
                'Percentage' => $percentage,
            ];

            $results[] = $resultRow;
        }

        return Inertia::render('Lp2m/DetailMonitoringLed', [
            'detail_pengajuan' => $results,
        ]);
    }

    public function penilaian($id_detail_pengajuan)
    {
        $cek_data = DokumenAkreditasiModel::find($id_detail_pengajuan);
        $id_dp = DetailPengajuanAkreditasiModel::where('id_detail_pengajuan', '=', $id_detail_pengajuan)->first('id_pengajuan');

        if ($cek_data == null) {
            return Inertia::render('BlankData', [
                'id' => $id_dp,
            ]);
        } else {
            $dokumen = DokumenAkreditasiModel::where('id_detail_pengajuan', '=', $id_detail_pengajuan)->get();

            return Inertia::render('Lp2m/DaftarDokumen', [
                'info_dokumen' => $dokumen,
                // dd($dokumen)
            ]);
        }
    }

    public function nilaiPengajuan($id_pengajuan){
        $pengajuan = SebaranBorangModel::where('id_pengajuan', '=', $id_pengajuan)->first();

        return Inertia::render('Lp2m/PenilaianDokumen', [
            'pengajuan' => $pengajuan,
            // dd($pengajuan)
        ]);
    }

    public function simpanNilai(Request $request){
        $request->validate([
            'nilai' => ['required'],
        ]);
        NilaiMonitoringModel::create([
            'id_pengajuan' => $request->id_pengajuan,
            'tgl_penilaian' => Carbon::now(),
            'nilai' => $request->nilai,
            'status' => 'a',
            'create_by' => $request->create_by
        ]);

        return to_route('monitoring-led.index')->with('message', 'Pengajuan Berhasil dinilai...');
    }
}
