<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\JenisBabModel;
use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSubBabModel;
use App\Models\Admin\LembagaAkreditasiModel;

class JenisSubBab extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getBabs(Request $request)
    {
        $Babs = JenisBabModel::where('id_lembaga_akreditasi', $request->input('akreditasi_id'))->get();

        return response()->json($Babs);
    }

    public function index()
    {
        $la = LembagaAkreditasiModel::where('status', 'a')->get();

        $data = JenisSubBabModel::join('tb_bab', 'tb_bab.id_bab', '=', 'tb_sub_bab.id_bab')
        ->join('tb_lembaga_akreditasi', 'tb_lembaga_akreditasi.id_lembaga_akreditasi', '=', 'tb_bab.id_lembaga_akreditasi')
        ->get();

        return Inertia::render('Admin/JenisSubBab', [
            'SubBab' => $data,
            'la' => $la,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_bab' => ['required'],
            'nama_sub_bab' => ['required'],
            'deskripsi_sub_bab' => ['required'],
        ]);

        JenisSubBabModel::create([
            'id_bab' => $request->id_bab,
            'nama_sub_bab' => $request->nama_sub_bab,
            'deskripsi_sub_bab' => $request->deskripsi_sub_bab,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return to_route('data-jenis-sub-bab.index')->with('message', 'Data Berhasil ditambahkan');
    }


    public function edit($id_sub_bab)
    {
        $data = JenisSubBabModel::find($id_sub_bab);

        $bab = JenisBabModel::with('lembaga_akreditasi')->get();

        return Inertia::render('Admin/Edit/EditJenisSubBab', [
            'data' => $data,
            'bab' => $bab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_sub_bab)
    {
        $ubah = JenisSubBabModel::find($id_sub_bab);
        
        $request->validate([
            'id_bab' => ['required'],
            'nama_sub_bab' => ['required'],
            'deskripsi_sub_bab' => ['required'],
        ]);

        $ubah->update([
            'id_bab' => $request->id_bab,
            'nama_sub_bab' => $request->nama_sub_bab,
            'deskripsi_sub_bab' => $request->deskripsi_sub_bab,
            'status' => 'a',
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
        ]);

        return to_route('data-jenis-sub-bab.index')->with('message', 'Data Berhasil diupdate');
    }


    public function editStatus($id_sub_bab)
    {
        $data = JenisSubBabModel::find($id_sub_bab);

        $bab = JenisBabModel::all();

        return Inertia::render('Admin/Edit/Status/EditStatusJenisSubBab', [
            'data' => $data,
            'bab' => $bab,
        ]);
    }

    public function updateStatus(Request $request, $id_sub_bab)
    {
        $ubah = JenisSubBabModel::find($id_sub_bab);

        $ubah_status = $request->status;

        if ($ubah_status == 'a') {
            $ubah->update([
                'id_bab' => $request->id_bab,
                'nama_sub_bab' => $request->nama_sub_bab,
                'deskripsi_sub_bab' => $request->deskripsi_sub_bab,
                'status' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-sub-bab.index')->with('message', 'Status berganti menjadi tidak aktif...');
        }else{
            $ubah->update([
                'id_bab' => $request->id_bab,
                'nama_sub_bab' => $request->nama_sub_bab,
                'deskripsi_sub_bab' => $request->deskripsi_sub_bab,
                'status' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-sub-bab.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sub_bab)
    {
        $hapus = JenisSubBabModel::find($id_sub_bab);

        if($hapus){
            $hapus->delete();
        }

        return to_route('data-jenis-sub-bab.index')->with('message', 'Data Berhasil dinonaktifkan');
    }
}
