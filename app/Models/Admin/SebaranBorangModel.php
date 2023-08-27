<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\LembagaAkreditasiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SebaranBorangModel extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_pengajuan';
    protected $table = 'tb_pengajuan_akreditasi';

    protected $fillable = [
        'id_lembaga_akreditasi',
        'id_lembaga',
        'tgl_pengajuan',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

    public function lembaga_akreditasi()
    {
        return $this->belongsTo(LembagaAkreditasiModel::class, 'id_lembaga_akreditasi', 'id_lembaga_akreditasi');
    }

    public function lembaga_unuja()
    {
        return $this->belongsTo(User::class, 'id_lembaga', 'id_lembaga');
    }
}
