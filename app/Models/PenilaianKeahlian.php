<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKeahlian extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian_keahlian';
    protected $primaryKey = 'id_penilaian_keahlian';
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
        'id_keahlian',
        'nilai',
        'bobot_nilai',
        'is_active'
    ];
}
