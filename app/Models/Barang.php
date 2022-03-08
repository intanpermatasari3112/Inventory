<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $primaryKey = "kode_barang";
    protected $table = 'barang';
    protected $fillable = ['kode_barang', 'nama_barang', 'jenis_barang', 'tanggal_masuk', 'harga_beli', 'gambar'];
    public function jenis (){
        return $this->hasOne(Jenis::class, "id_jenis_barang", "jenis_barang");
    }

    public function stok() {
        return $this->hasMany(Stok::class, 'kode_barang', 'kode_barang');
    }
}
