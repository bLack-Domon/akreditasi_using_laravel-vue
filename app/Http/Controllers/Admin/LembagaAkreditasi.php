<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LembagaAkreditasiModel;

class LembagaAkreditasi extends Controller
{
    public function index(Request $request)
    {
        $data = LembagaAkreditasiModel::all();


        return Inertia::render(
            'Admin/LembagaAkreditasi',
            [
                'LembagaAkreditasi' => $data,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lembaga' => ['required', 'unique:tb_lembaga_akreditasi,nama_lembaga'],
            'alamat' => ['required'],
            'tlp' => ['required', 'numeric'],
            'email' => ['required', 'max:50', 'email', 'unique:tb_lembaga_akreditasi,email'],
            'website' => ['required'],
        ]);

        LembagaAkreditasiModel::create([
            'nama_lembaga' => $request->nama_lembaga,
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
            'email' => $request->email,
            'website' => $request->website,
            'status' => 'a',
            'create_by' => $request->create_by,
        ]);

        return to_route('data-lembaga-akreditasi.index')->with('message', 'Data Berhasil ditambah');
    }

    public function edit($id_lembaga_akreditasi)
    {
        $data = LembagaAkreditasiModel::find($id_lembaga_akreditasi);

        return Inertia::render('Admin/Edit/EditLembagaAkreditasi', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id_lembaga_akreditasi)
    {
        $ubah = LembagaAkreditasiModel::find($id_lembaga_akreditasi);
        
        $request->validate([
            'nama_lembaga' => ['required'],
            'alamat' => ['required'],
            'tlp' => ['required', 'numeric'],
            'email' => ['required', 'max:50', 'email'],
            'website' => ['required'],
        ]);

        $ubah->update([
            'nama_lembaga' => $request->nama_lembaga,
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
            'email' => $request->email,
            'website' => $request->website,
            'status' => 'a',
            'create_by' => $request->create_by,
            'update_by' => $request->update_by,
        ]);

        return to_route('data-lembaga-akreditasi.index')->with('message', 'Data Berhasil diubah');
    }

    public function editStatus($id_lembaga_akreditasi)
    {
        $data = LembagaAkreditasiModel::find($id_lembaga_akreditasi);

        return Inertia::render('Admin/Edit/Status/EditStatusLembagaAkreditasi', [
            'data' => $data,
        ]);
    }

    public function updateStatus(Request $request, $id_lembaga_akreditasi)
    {
        $ubah = LembagaAkreditasiModel::find($id_lembaga_akreditasi);

        $ubah_status = $request->status;

        if ($ubah_status == 'a') {
            $ubah->update([
                'nama_lembaga' => $request->nama_lembaga,
                'alamat' => $request->alamat,
                'tlp' => $request->tlp,
                'email' => $request->email,
                'website' => $request->website,
                'status' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-lembaga-akreditasi.index')->with('message', 'Status berganti menjadi tidak aktif...');
        }else{
            $ubah->update([
                'nama_lembaga' => $request->nama_lembaga,
                'alamat' => $request->alamat,
                'tlp' => $request->tlp,
                'email' => $request->email,
                'website' => $request->website,
                'status' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-lembaga-akreditasi.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }

    public function destroy($id_lembaga_akreditasi)
    {
        $hapus = LembagaAkreditasiModel::find($id_lembaga_akreditasi);

        if ($hapus) {
            $hapus->delete();
        }

        return to_route('data-lembaga-akreditasi.index')->with('message', 'Data Berhasil dinonaktifkan');
    }
}
