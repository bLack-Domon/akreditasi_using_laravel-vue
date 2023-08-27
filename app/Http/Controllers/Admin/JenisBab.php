<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\JenisBabModel;
use App\Http\Controllers\Controller;
use App\Models\Admin\LembagaAkreditasiModel;

class JenisBab extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisBabModel::with('lembaga_akreditasi')->get();
        $LembagaAkreditasi = LembagaAkreditasiModel::all();

        return Inertia::render('Admin/JenisBab', [
            'JenisBab' => $data,
            'lembaga_akreditasi' => $LembagaAkreditasi,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_lembaga_akreditasi' => ['required'],
            'nama_bab' => ['required'],
            'deskripsi_bab' => ['required'],
        ]);

        JenisBabModel::create([
            'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
            'nama_bab' => $request->nama_bab,
            'deskripsi_bab' => $request->deskripsi_bab,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return to_route('data-jenis-bab.index')->with('message', 'Data Berhasil ditambahkan');
    }

    public function edit($id_bab)
    {
        $data = JenisBabModel::find($id_bab);
        $LembagaAkreditasi = LembagaAkreditasiModel::all();

        return Inertia::render('Admin/Edit/EditJenisBab', [
            'data' => $data,
            'lembaga_akreditasi' => $LembagaAkreditasi,
        ]);
    }


    public function update(Request $request, $id_bab)
    {
        $ubah = JenisBabModel::find($id_bab);
        $request->validate([
            'id_lembaga_akreditasi' => ['required'],
            'nama_bab' => ['required'],
            'deskripsi_bab' => ['required'],
        ]);
        $ubah->update([
            'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
            'nama_bab' => $request->nama_bab,
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
            'status' => 'a',
            'deskripsi_bab' => $request->deskripsi_bab,
        ]);

        return to_route('data-jenis-bab.index')->with('message', 'Data Berhasil diupdate');
    }

    
    public function editStatus($id_bab)
    {
        $data = JenisBabModel::find($id_bab);
        $LembagaAkreditasi = LembagaAkreditasiModel::all();

        return Inertia::render('Admin/Edit/Status/EditStatusJenisBab', [
            'data' => $data,
            'LembagaAkreditasi' => $LembagaAkreditasi,
        ]);
    }

    public function updateStatus(Request $request, $id_bab)
    {
        $ubah = JenisBabModel::find($id_bab);

        $ubah_status = $request->status;

        if ($ubah_status == 'a') {
            $ubah->update([
                'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
                'nama_bab' => $request->nama_bab,
                'deskripsi_bab' => $request->deskripsi_bab,
                'status' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-bab.index')->with('message', 'Status berganti menjadi tidak aktif...');
        }else{
            $ubah->update([
                'id_lembaga_akreditasi' => $request->id_lembaga_akreditasi,
                'nama_bab' => $request->nama_bab,
                'deskripsi_bab' => $request->deskripsi_bab,
                'status' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-jenis-bab.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }


    public function destroy($id_bab)
    {
        $hapus = JenisBabModel::find($id_bab);

        if($hapus){
            $hapus->delete();
        }

        return to_route('data-jenis-bab.index')->with('message', 'Data Berhasil dinonaktifkan');
    }
}
