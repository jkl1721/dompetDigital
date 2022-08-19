<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    protected $keyType = 'string';
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
    public function jenis_transaksis()
    {
        return $this->belongsTo('App\Models\jenis_transaksi', 'id_jenis');
    }
    public function kategoris()
    {
        return $this->belongsTo('App\Models\kategori', 'id_kategori');
    }
}
