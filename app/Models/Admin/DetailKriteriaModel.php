<?php

namespace App\Models\Admin;

use App\Models\Admin\JenisBabModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\JenisKriteriaModel;
use App\Models\Admin\JenisSubKriteriaModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailKriteriaModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_detail_kriteria';
    protected $table = 'tb_detail_kriteria';

    protected $fillable = [
        'id_detail_bab',
        'id_kriteria',
        'id_sub_kriteria',
    ];

    public function detailbab()
    {
        return $this->belongsTo(JenisBabModel::class, 'id_bab', 'id_detail_bab');
    }

    public function kriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'id_kriteria', 'id_kriteria');
    }

    public function subkriteria()
    {
        return $this->belongsTo(JenisSubKriteriaModel::class, 'id_sub_kriteria', 'id_sub_kriteria');
    }
}
