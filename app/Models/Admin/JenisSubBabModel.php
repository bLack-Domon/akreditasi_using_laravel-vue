<?php

namespace App\Models\Admin;

use App\Models\Admin\JenisBabModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSubBabModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';

    protected $primaryKey = 'id_sub_bab';
    protected $table = 'tb_sub_bab';

    protected $fillable = [
        'id_bab',
        'nama_sub_bab',
        'deskripsi_sub_bab',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    public function bab()
    {
        return $this->belongsTo(JenisBabModel::class, 'id_bab', 'id_bab');
    }
}
