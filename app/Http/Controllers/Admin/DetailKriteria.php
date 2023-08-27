<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Admin\JenisSubBabModel;
use App\Http\Controllers\Controller;
use App\Models\Admin\JenisKriteriaModel;
use App\Models\Admin\DetailKriteriaModel;
use App\Models\Admin\JenisSubKriteriaModel;

class DetailKriteria extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DetailKriteriaModel::where('status', '<>', 't')->get();
        $bab = JenisSubBabModel::all();
        $kriteria = JenisKriteriaModel::all();
        $subkriteria = JenisSubKriteriaModel::all();
        return Inertia::render('Admin/DetailKriteria', [
            'data' => $data,
            'bab' => $bab,
            'kriteria' => $kriteria,
            'subkriteria' => $subkriteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
