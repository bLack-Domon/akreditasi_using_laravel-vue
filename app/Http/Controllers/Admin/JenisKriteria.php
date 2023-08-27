<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisBabModel;
use App\Models\Admin\JenisKriteriaModel;
use App\Models\Admin\JenisSubBabModel;
use App\Models\Admin\LembagaAkreditasiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JenisKriteria extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getBabs(Request $request)
    {
        $Babs = JenisBabModel::where('id_lembaga_akreditasi', $request->input('akreditasi_id'))->get();

        return response()->json($Babs);
    }

    public function getSubBabs(Request $request)
    {
        $subBabs = JenisSubBabModel::where('id_bab', $request->input('bab_id'))->get();

        return response()->json($subBabs);
    }

    public function index()
    {
        $la = LembagaAkreditasiModel::where('status', 'a')->get();

        $data = JenisKriteriaModel::
            join('tb_sub_bab', 'tb_sub_bab.id_sub_bab', '=', 'tb_kriteria.id_sub_bab')->
            join('tb_bab', 'tb_bab.id_bab', '=', 'tb_sub_bab.id_bab')->
            join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_bab.id_lembaga_akreditasi')->
            get([
            'tb_kriteria.*',
            'tb_sub_bab.id_sub_bab', 'tb_sub_bab.nama_sub_bab',
            'tb_bab.nama_bab',
            'tb_lembaga_akreditasi.nama_lembaga',
        ]);

        return Inertia::render('Admin/JenisKriteria', [
            'kriteria' => $data,
            'la' => $la,
            // dd($data),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sub_bab' => ['required'],
            'nama_kriteria' => ['required'],
            'deskripsi' => ['required'],
        ]);

        JenisKriteriaModel::create([
            'id_sub_bab' => $request->id_sub_bab,
            'nama_kriteria' => $request->nama_kriteria,
            'deskripsi' => $request->deskripsi,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return to_route('data-jenis-kriteria.index')->with('message', 'Data Berhasil ditambahkan');
    }

    public function edit($id_kriteria)
    {
        $data = JenisKriteriaModel::find($id_kriteria);

        $bab = JenisSubBabModel::with('bab')->get();
        return Inertia::render('Admin/Edit/EditJenisKriteria', [
            'data' => $data,
            'bab' => $bab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kriteria)
    {
        $ubah = JenisKriteriaModel::find($id_kriteria);

        $request->validate([
            'id_sub_bab' => ['required'],
            'nama_kriteria' => ['required'],
            'deskripsi' => ['required'],
        ]);

        $ubah->update([
            'id_sub_bab' => $request->id_sub_bab,
            'nama_kriteria' => $request->nama_kriteria,
            'deskripsi' => $request->deskripsi,
            'status' => 'a',
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
        ]);

        return to_route('data-jenis-kriteria.index')->with('message', 'Data Berhasil diupdate');
    }

    public function editStatus($id_kriteria)
    {
        $data = JenisKriteriaModel::find($id_kriteria);

        $bab = JenisBabModel::all();

        return Inertia::render('Admin/Edit/Status/EditStatusJenisKriteria', [
            'data' => $data,
            'bab' => $bab,
        ]);
    }

    public function updateStatus(Request $request, $id_kriteria)
    {
        $ubah = JenisKriteriaModel::find($id_kriteria);

        $ubah_status = $request->status;

        if ($ubah_status == 'a') {
            $ubah->update([
                'id_sub_bab' => $request->id_sub_bab,
                'nama_kriteria' => $request->nama_kriteria,
                'deskripsi' => $request->deskripsi,
                'status' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-kriteria.index')->with('message', 'Status berganti menjadi tidak aktif...');
        } else {
            $ubah->update([
                'id_sub_bab' => $request->id_sub_bab,
                'nama_kriteria' => $request->nama_kriteria,
                'deskripsi' => $request->deskripsi,
                'status' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-kriteria.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kriteria)
    {
        $hapus = JenisKriteriaModel::find($id_kriteria);

        if ($hapus) {
            $hapus->delete();
        }

        return to_route('data-jenis-kriteria.index')->with('message', 'Data Berhasil dinonaktifkan');
    }
}
