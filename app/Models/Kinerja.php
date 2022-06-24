<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    use HasFactory;

    protected $table = 'tb_kinerja';
    protected $primaryKey = 'id_kinerja';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_kinerja',
        'kinerja',
        'id_kategori',
        'id_divisi',
        'bobot',
        'target',
        'is_active'
    ];
}
