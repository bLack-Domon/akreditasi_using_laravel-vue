<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DetailPengajuanAkreditasiModel;
use App\Models\Admin\JenisBabModel;
use App\Models\Admin\JenisKriteriaModel;
use App\Models\Admin\JenisSubBabModel;
use App\Models\Admin\JenisSubKriteriaModel;
use App\Models\Admin\LembagaAkreditasiModel;
use App\Models\Admin\SebaranBorangModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SebaranBorang extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $data = SebaranBorangModel::with(['lembaga_akreditasi', 'lembaga_unuja'])->where('create_by', '=', $user->nama_lembaga)->get();

        $lembaga_akreditasi = LembagaAkreditasiModel::all();
        $lembaga_unuja = User::where('status_akun', '<>', 'admin')->get();
        return Inertia::render('Kaprodi/SebaranBorang', [
            'PengajuanAkreditasi' => $data,
            'lembaga_akreditasi' => $lembaga_akreditasi,
            'lembaga_unuja' => $lembaga_unuja,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lembaga' => ['required'],
            'id_lembaga_akreditasi' => ['required'],
            'tgl_pengajuan' => ['required'],
        ]);

        SebaranBorangModel::create([
            'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
            'id_lembaga' => $request->id_lembaga,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return to_route('pengajuan-akreditasi-prodi.index')->with('message', 'Data Berhasil ditambahkan');
    }

    public function edit($id_pengajuan)
    {

        $data = SebaranBorangModel::find($id_pengajuan);

        $lembaga_akreditasi = LembagaAkreditasiModel::all();
        $lembaga_unuja = User::where('status_akun', '<>', 'admin')->get();
        return Inertia::render('Admin/Edit/EditSebaranBorang', [
            'data' => $data,
            'lembaga_akreditasi' => $lembaga_akreditasi,
            'lembaga_unuja' => $lembaga_unuja,
        ]);
    }

    public function update(Request $request, $id_pengajuan)
    {

        $ubah = SebaranBorangModel::find($id_pengajuan);

        $request->validate([
            'id_lembaga' => ['required'],
            'id_lembaga_akreditasi' => ['required'],
            'tgl_pengajuan' => ['required'],
        ]);

        $ubah->update([
            'id_lembaga' => $request->id_lembaga,
            'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'status' => $request->status,
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
        ]);

        return to_route('pengajuan-akreditasi-prodi.index')->with('message', 'Data Berhasil diupdate');
    }

    // API Detail Sebaran Borang / Detail Pengajuan Akreditasi

    public function getDeskripsi(Request $request)
    {
        $deskripsiBab = JenisBabModel::where('id_bab', $request->input('bab_id'))->first('deskripsi_bab');

        return response()->json($deskripsiBab);
    }

    public function getSubBabs(Request $request)
    {
        $subBabs = JenisSubBabModel::where('id_bab', $request->input('bab_id'))->get();

        return response()->json($subBabs);
    }

    public function getKriteria(Request $request)
    {
        $kriteria = JenisKriteriaModel::where('id_sub_bab', $request->input('subbab_id'))->get();

        return response()->json($kriteria);
    }

    public function getSubKriteria(Request $request)
    {
        $subkriteria = JenisSubKriteriaModel::where('id_kriteria', $request->input('kriteria_id'))->get();

        return response()->json($subkriteria);
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

        $pengajuan_akreditasi = SebaranBorangModel::with(['lembaga_akreditasi', 'lembaga_unuja'])->where('id_pengajuan', '=', $id_pengajuan)->first();

        $bab = JenisBabModel::with('lembaga_akreditasi')->where('id_lembaga_akreditasi', '=', $pengajuan_akreditasi->id_lembaga_akreditasi)->get();

        return Inertia::render('Kaprodi/Detail/DetailSebaranBorang', [
            // dd($results),
            'data' => $results,

            'pa' => $pengajuan_akreditasi,

            'bab' => $bab,
        ]);
    }

    public function editStatus($id_pengajuan)
    {
        $data = SebaranBorangModel::find($id_pengajuan);

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
