<?php
namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LembagaUnuja extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('status_akun', '<>', 'admin')->orderBy('nama_lembaga', 'asc')->get();
        $fakultas = User::where('status_akun', '=', 'lembaga')->orderBy('nama_lembaga', 'asc')->get();


        return Inertia::render('Admin/LembagaUnuja',
            [
                'LembagaUnuja' => $data,
                'fakultas' => $fakultas,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lembaga' => ['required', 'unique:tb_lembaga_unuja,nama_lembaga'],
            'status_akun' => ['required'],
            'user' => ['required', 'unique:tb_lembaga_unuja,user'],
            'password' => ['required', 'min:8'],
        ]);
        User::create([
            'nama_lembaga' => $request->nama_lembaga,
            'status_akun' => $request->status_akun,
            'id_fakultas' => $request->fakultas,
            'user' => $request->user,
            'status_aktif' => 'a',
            'create_by' => $request->create_by,
            'password' => Hash::make($request->password),
        ]);

        return to_route('data-lembaga-unuja.index')->with('message', 'Data Berhasil ditambahkan');
    }

    public function edit($id_lembaga)
    {
        $data = User::find($id_lembaga);
        $fakultas = User::where('status_akun', '=', 'lembaga')->orderBy('nama_lembaga', 'asc')->get();

        return Inertia::render('Admin/Edit/EditLembagaUnuja', [
            'data' => $data,
            'fakultas' => $fakultas,
        ]);
    }

    public function update(Request $request, $id_lembaga)
    {
        $ubah = User::find($id_lembaga);

        $request->validate([
            'nama_lembaga' => ['required'],
            'status_akun' => ['required'],
            'fakultas' => ['required'],
            'user' => ['required'],
        ]);

        if ($request->password == '') {
            $ubah->update([
                'nama_lembaga' => $request->nama_lembaga,
                'status_akun' => $request->status_akun,
                'id_fakultas' => $request->fakultas,
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'status_aktif' => 'a',
                'user' => $request->user,
            ]);
            return to_route('data-lembaga-unuja.index')->with('message', 'Data Berhasil diupdate');
        } else {
            $ubah->update([
                'nama_lembaga' => $request->nama_lembaga,
                'status_akun' => $request->status_akun,
                'id_fakultas' => $request->fakultas,
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'status_aktif' => 'a',
                'user' => $request->user,
                'password' => Hash::make($request->password),

            ]);
            return to_route('data-lembaga-unuja.index')->with('message', 'Data Berhasil diupdate');
        }

    }

    
    public function editStatus($id_lembaga)
    {
        $data = User::find($id_lembaga);

        return Inertia::render('Admin/Edit/Status/EditStatusLembagaUnuja', [
            'data' => $data,
        ]);
    }

    public function updateStatus(Request $request, $id_lembaga)
    {
        $ubah = User::find($id_lembaga);

        $ubah_status = $request->status_aktif;

        if ($ubah_status == 'a') {
            $ubah->update([
                'nama_lembaga' => $request->nama_lembaga,
                'status_akun' => $request->status_akun,
                'user' => $request->user,
                'status_aktif' => 't',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-lembaga-unuja.index')->with('message', 'Status berganti menjadi tidak aktif...');
        }else{
            $ubah->update([
                'nama_lembaga' => $request->nama_lembaga,
                'status_akun' => $request->status_akun,
                'user' => $request->user,
                'status_aktif' => 'a',
                'create_by' => $request->create_by,
                'update_by' => $request->update_by,
                'delete_by' => $request->delete_by,
                'delete_date' => Carbon::now(),
            ]);

            return to_route('data-lembaga-unuja.index')->with('message', 'Status berganti menjadi aktif...');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_lembaga)
    {
        $hapus = User::find($id_lembaga);

        if ($hapus) {
            $hapus->delete();
        }

        return to_route('data-lembaga-unuja.index')->with('message', 'Data Berhasil dinonaktifkan');
    }
}
