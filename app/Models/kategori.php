<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $keyType = 'int';
    public $timestamps = false;
    public function transaksis()
    {
        return $this->hasMany('App\Models\transaksi', 'id_kategori');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
