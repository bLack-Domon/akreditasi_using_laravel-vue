<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\LembagaAkreditasiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBabModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_bab';
    protected $table = 'tb_bab';

    protected $fillable = [
        'id_lembaga_akreditasi',
        'nama_bab',
        'deskripsi_bab',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    /**
     * Get the user that owns the JenisBabModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lembaga_akreditasi()
    {
        return $this->belongsTo(LembagaAkreditasiModel::class, 'id_lembaga_akreditasi', 'id_lembaga_akreditasi');
    }
}