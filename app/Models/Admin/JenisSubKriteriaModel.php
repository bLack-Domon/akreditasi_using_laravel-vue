<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\JenisKriteriaModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSubKriteriaModel extends Model
{
    use HasFactory;
    
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_sub_kriteria';
    protected $table = 'tb_sub_kriteria';

    protected $fillable = [
        'id_kriteria',
        'nama_sub_kriteria',
        'deskripsi',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    /**
     * Get the user that owns the JenisSubKriteriaModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'id_kriteria', 'id_kriteria');
    }
}
