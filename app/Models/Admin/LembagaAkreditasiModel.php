<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LembagaAkreditasiModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $table = 'tb_lembaga_akreditasi';
    protected $primaryKey = 'id_lembaga_akreditasi';
    protected $fillable = [
        'nama_lembaga',
        'alamat',
        'tlp',
        'email',
        'website',
        'status',
        'create_by',
        'update_by',
        'delete_by',
        'delete_date',
    ];

}
