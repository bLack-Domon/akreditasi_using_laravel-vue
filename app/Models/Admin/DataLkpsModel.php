<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataLkpsModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_pengajuan_lkps';
    protected $table = 'tb_pengajuan_lkps';

    protected $fillable = [
        'id_lembaga',
        'tgl_pengajuan',
        'tgl_penilaian',
        'nama_dokumen',
        'akses_dokumen',
        'patch_dokumen',
        'nilai_lkps',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    /**
     * Get the user that owns the DataLkpsModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lembaga_unuja()
    {
        return $this->belongsTo(User::class, 'id_lembaga', 'id_lembaga');
    }
}
