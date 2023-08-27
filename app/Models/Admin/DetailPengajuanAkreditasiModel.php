<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\JenisKriteriaModel;
use App\Models\Admin\SebaranBorangModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPengajuanAkreditasiModel extends Model
{    use HasFactory;
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_detail_pengajuan';
    protected $table = 'tb_detail_pengajuan_akreditasi';

    protected $fillable = [
        'id_pengajuan',
        'id_kriteria',
        'deskripsi_isian',
        'tgl_pengisian',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    public function pengajuan_akreditasi()
    {
        return $this->belongsTo(SebaranBorangModel::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function kriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'id_kriteria', 'id_kriteria');
    }
}
