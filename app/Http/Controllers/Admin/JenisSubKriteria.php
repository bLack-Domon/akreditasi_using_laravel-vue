<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\JenisBabModel;
use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSubBabModel;
use App\Models\Admin\JenisKriteriaModel;
use App\Models\Admin\JenisSubKriteriaModel;
use App\Models\Admin\LembagaAkreditasiModel;

class JenisSubKriteria extends Controller
{

    public function getBab(Request $request)
    {
        $Bab = JenisBabModel::where('id_lembaga_akreditasi', $request->input('akreditasi_id'))->get();

        return response()->json($Bab);
    }

    public function getSubBab(Request $request)
    {
        $SubBab = JenisSubBabModel::where('id_bab', $request->input('bab_id'))->get();

        return response()->json($SubBab);
    }

    public function getKriteria(Request $request)
    {
        $kriteria = JenisKriteriaModel::where('id_sub_bab', $request->input('subBab_id'))->get();

        return response()->json($kriteria);
    }

    public function index()
    {
        $data = JenisSubKriteriaModel::
        join('tb_kriteria', 'tb_kriteria.id_kriteria', '=', 'tb_sub_kriteria.id_kriteria')->
        join('tb_sub_bab', 'tb_sub_bab.id_sub_bab', '=', 'tb_kriteria.id_sub_bab')->
        join('tb_bab', 'tb_bab.id_bab', '=', 'tb_sub_bab.id_bab')->
        join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_bab.id_lembaga_akreditasi')->
        get([
            'tb_sub_kriteria.*',
            'tb_kriteria.id_kriteria', 'tb_kriteria.nama_kriteria',
            'tb_sub_bab.nama_sub_bab',
            'tb_bab.nama_bab',
            'tb_lembaga_akreditasi.nama_lembaga',
        ]);

        $la = LembagaAkreditasiModel::where('status', 'a')->get();

        return Inertia::render('Admin/JenisSubKriteria', [
            'SubKriteria' => $data,
            'la' => $la,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => ['required'],
            'nama_sub_kriteria' => ['required'],
            'deskripsi' => ['required'],
        ]);

        JenisSubKriteriaModel::create([
            'id_kriteria' => $request->id_kriteria,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'deskripsi' => $request->deskripsi,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return to_route('data-jenis-sub-kriteria.index')->with('message', 'Data Berhasil ditambahkan');
    }


    public function edit($id_sub_kriteria)
    {
        $data = JenisSubKriteriaModel::find($id_sub_kriteria);

        $kriteria = JenisKriteriaModel::all();
        return Inertia::render('Admin/Edit/EditJenisSubKriteria', [
            'data' => $data,
            'kriteria' => $kriteria,
        ]);
    }


    public function update(Request $request, $id_sub_kriteria)
    {
        $ubah = JenisSubKriteriaModel::find($id_sub_kriteria);
        
        $request->validate([
            'id_kriteria' => ['required'],
            'nama_sub_kriteria' => ['required'],
            'deskripsi' => ['required'],
        ]);

        $ubah->update([
            'id_kriteria' => $request->id_kriteria,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'deskripsi' => $request->deskripsi,
            'status' => 'a',
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
        ]);

        return to_route('data-jenis-sub-kriteria.index')->with('message', 'Data Berhasil diupdate');
    }


    public function editStatus($id_sub_kriteria)
    {
        $data = JenisSubKriteriaModel::find($id_sub_kriteria);

        $kriteria = JenisKriteriaModel::all();

        return Inertia::render('Admin/Edit/Status/EditStatusJenisSubKriteria', [
            'data' => $data,
            'kriteria' => $kriteria,
        ]);
    }

    public function updateStatus(Request $request, $id_sub_kriteria)
    {
        $ubah = JenisSubKriteriaModel::find($id_sub_kriteria);

        $ubah_status = $request->status;

        if ($ubah_status == 'a') {
            $ubah->update([
                'id_kriteria' => $request->id_kriteria,
                'nama_sub_kriteria' => $request->nama_sub_kriteria,
                'deskripsi' => $request->deskripsi,
                'status' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-sub-kriteria.index')->with('message', 'Status berganti menjadi tidak aktif...');
        }else{
            $ubah->update([
                'id_kriteria' => $request->id_kriteria,
                'nama_sub_kriteria' => $request->nama_sub_kriteria,
                'deskripsi' => $request->deskripsi,
                'status' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-sub-kriteria.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sub_kriteria)
    {
        $hapus = JenisSubKriteriaModel::find($id_sub_kriteria);

        if($hapus){
            $hapus->delete();
        }

        return to_route('data-jenis-sub-kriteria.index')->with('message', 'Data Berhasil dinonaktifkan');
    }
}
