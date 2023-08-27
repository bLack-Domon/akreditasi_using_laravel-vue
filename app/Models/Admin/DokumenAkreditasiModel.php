<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DetailPengajuanAkreditasiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenAkreditasiModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';

    protected $primaryKey = 'id_dokumen';
    protected $table = 'tb_dokumen_akreditasi';

    protected $fillable = [
        'id_detail_pengajuan',
        'nama_dokumen',
        'akses_dokumen',
        'patch_dokumen',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    public function detail_pengajuan()
    {
        return $this->belongsTo(DetailPengajuanAkreditasiModel::class, 'id_detail_pengajuan', 'id_detail_pengajuan');
    }
}
