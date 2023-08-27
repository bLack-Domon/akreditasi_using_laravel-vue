<?php

namespace App\Models\Admin;

use App\Models\Admin\JenisBabModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisKriteriaModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_kriteria';
    protected $table = 'tb_kriteria';

    protected $fillable = [
        'id_sub_bab',
        'nama_kriteria',
        'deskripsi',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    /**
     * Get the user that owns the JenisKriteriaModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_bab()
    {
        return $this->belongsTo(JenisSubBabModel::class, 'id_sub_bab', 'id_sub_bab');
    }
}
