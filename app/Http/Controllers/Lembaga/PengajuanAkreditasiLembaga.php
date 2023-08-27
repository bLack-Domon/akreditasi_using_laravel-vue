<?php

namespace App\Http\Controllers\Lembaga;

use App\Http\Controllers\Controller;
use App\Models\Admin\DetailPengajuanAkreditasiModel;
use App\Models\Admin\DokumenAkreditasiModel;
use App\Models\Admin\SebaranBorangModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PengajuanAkreditasiLembaga extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $data = User::where('id_fakultas', '=', $user->id_lembaga)->where('status_aktif', '=', 'a')->get();

        return Inertia::render('Lembaga/DaftarProdiFakultas', [
            'data' => $data,
        ]);
    }

    public function detail($id_lembaga)
    {
        $data = SebaranBorangModel::leftJoin('tb_nilai_monitoring', 'tb_nilai_monitoring.id_pengajuan', '=', 'tb_pengajuan_akreditasi.id_pengajuan')->with(['lembaga_akreditasi', 'lembaga_unuja'])->where('tb_pengajuan_akreditasi.id_lembaga', '=', $id_lembaga)->get(['tb_pengajuan_akreditasi.*', 'tb_nilai_monitoring.nilai']);

        return Inertia::render('Lembaga/PengajuanAkreditasiLembaga', [
            'data' => $data,
            // dd($data),
        ]);
    }

    public function detailPengajuan($id_pengajuan)
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

        return Inertia::render('Lembaga/DetailPengajuanAkreditasiLembaga', [
            // dd($data),
            'detail_pengajuan' => $results,
        ]);
    }

    public function showDokumen($id_detail_pengajuan)
    {
        $cek_data = DokumenAkreditasiModel::find($id_detail_pengajuan);
        $id_dp = DetailPengajuanAkreditasiModel::where('id_detail_pengajuan', '=', $id_detail_pengajuan)->first('id_pengajuan');

        if ($cek_data == null) {
            return Inertia::render('BlankData', [
                'id' => $id_dp,
            ]);
        } else {
            $dokumen = DokumenAkreditasiModel::where('id_detail_pengajuan', '=', $id_detail_pengajuan)->get();

            return Inertia::render('Lembaga/DaftarDokumen', [
                'info_dokumen' => $dokumen,
                // dd($dokumen)
            ]);
        }
    }

    public function SimpanDokumen(Request $request)
    {
        $request->validate([
            'nama_dokumen' => ['required'],
            'patch_dokumen' => ['required', 'mimes: doc,pdf,docx'],
        ]);

        if ($request->hasFile('patch_dokumen')) {
            $dokumen = $request->file('patch_dokumen')->store('dokumenku');

            DokumenAkreditasiModel::create([
                'id_detail_pengajuan' => $request->id_detail_pengajuan,
                'nama_dokumen' => $request->nama_dokumen,
                'patch_dokumen' => $dokumen,
                'status' => 'a',
                'create_by' => $request->create_by,
            ]);

            return back()->with('message', 'Data Berhasil ditambahkan');
        }
    }

}
