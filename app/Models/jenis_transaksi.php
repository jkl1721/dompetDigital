<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_transaksi extends Model
{
    use HasFactory;
    protected $table = 'jenis_transaksis';
    protected $primaryKey = 'id_jenis';
    protected $keyType = 'int';
    public $timestamps = false;
    public function transaksis()
    {
        return $this->hasMany('App\Models\transaksi', 'id_jenis');
    }
    public function kategoris()
    {
        return $this->hasMany('App\Models\kategori', 'id_jenis');
    }
}
