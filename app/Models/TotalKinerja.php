<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalKinerja extends Model
{
    use HasFactory;

    protected $table = 'tb_total_kinerja';
    protected $primaryKey = 'id_total_kinerja';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_karyawan',
        'id_form',
        'atasan',
        'hrd',
        'direktur',
        'sub_total1',
        'sub_total2',
        'sub_total3',
        'total',
        'is_active'
    ];
}
