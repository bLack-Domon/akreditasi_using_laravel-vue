<?php

namespace App\Http\Controllers\Prodi;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\DataLkpsModel;
use App\Http\Controllers\Controller;

class UploadLkpsProdi extends Controller
{
    public function index(Request $request){
        $cekUser = $request->user();
        $data = DataLkpsModel::where('id_lembaga', '=', $cekUser->id_lembaga)->with('lembaga_unuja')->get();

        return Inertia::render('Kaprodi/UploadLkpsProdi', [
            'DataLkps' => $data
        ]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => ['required'],
            'akses_dokumen' => ['required'],
            'patch_dokumen' => ['required', 'mimes: doc,pdf,docx']
        ]);

        if ($request->hasFile('patch_dokumen')) {
            $dokumen = $request->file('patch_dokumen')->store('pengajuan-lkps');

            DataLkpsModel::create([
                'id_lembaga' => $request->id_lembaga,
                'nama_dokumen' => $request->nama_dokumen,
                'akses_dokumen' => $request->akses_dokumen,
                'patch_dokumen' => $dokumen,
                'status' => 'a',
                'tgl_pengajuan' => Carbon::now(),
                'create_by' => $request->create_by,
            ]);

            return back()->with('message', 'Data Berhasil ditambahkan');
        }
    }

    public function editAkses($id_pengajuan_lkps){
        $data = DataLkpsModel::find($id_pengajuan_lkps);

        return Inertia::render('Kaprodi/AksesDokumen/UbahAksesDokumen', [
            'data' => $data,
        ]);
    }


    public function updateAkses(Request $request, $id_pengajuan_lkps)
    {
        $ubah = DataLkpsModel::find($id_pengajuan_lkps);
        $ubah_status = $request->akses_dokumen;

        if ($ubah_status == 'bisa') {
            $ubah->update([
                'akses_dokumen' => 'tidak',
                'update_by' => $request->update_by,
            ]);

            return redirect()->to('upload-lkps-prodi')->with('message', 'Akses berganti menjadi tidak bisa diakses prodi lain...');
        }else{
            $ubah->update([
                'akses_dokumen' => 'bisa',
                'update_by' => $request->update_by,
            ]);

            return redirect()->to('upload-lkps-prodi')->with('message', 'Akses berganti menjadi bisa diakses prodi lain...');
        }
    }
}
