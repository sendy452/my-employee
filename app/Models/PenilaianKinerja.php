<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKinerja extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian_kinerja';
    protected $primaryKey = 'id_penilaian_kinerja';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_karyawan',
        'id_form',
        'bulan',
        'id_kinerja',
        'nilai',
        'bobot_nilai',
        'is_active'
    ];
}
