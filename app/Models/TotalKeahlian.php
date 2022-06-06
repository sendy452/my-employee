<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalKeahlian extends Model
{
    use HasFactory;

    protected $table = 'tb_total_keahlian';
    protected $primaryKey = 'id_total_keahlian';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_karyawan',
        'id_divisi',
        'id_form',
        'bulan',
        'atasan',
        'hrd',
        'direktur',
        'total',
        'is_active'
    ];
}
