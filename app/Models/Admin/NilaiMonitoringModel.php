<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\SebaranBorangModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiMonitoringModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'create_date';
    const UPDATED_AT = 'update_date';
    protected $primaryKey = 'id_nilai_monitoring';
    protected $table = 'tb_nilai_monitoring';

    protected $fillable = [
        'id_pengajuan',
        'tgl_penilaian',
        'nilai',
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
    public function pengajuan_akreditasi()
    {
        return $this->belongsTo(SebaranBorangModel::class, 'id_pengajuan', 'id_pengajuan');
    }

}
