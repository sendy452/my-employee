<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    use HasFactory;

    protected $table = 'tb_keahlian';
    protected $primaryKey = 'id_keahlian';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_keahlian',
        'id_divisi',
        'keahlian',
        'bobot',
        'is_active'
    ];
}
