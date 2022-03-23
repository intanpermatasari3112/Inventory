<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $keyType = "string";
    protected $primaryKey = "kode_barang";
    protected $table = 'barang';
    protected $fillable = ['jenis_barang','kode_barang', 'nama_barang', 'merek','kondisi','satuan','jumlah_beli', 'tanggal_masuk', 'harga_beli', 'nama_supplier', 'gambar'];
    public function jenis (){
        return $this->hasOne(Jenis::class, "id_jenis_barang", "jenis_barang");
    }

    public function stok() {
        return $this->hasMany(Stok::class, 'kode_barang', 'kode_barang');
    }

    public function stokone() {
        return $this->hasOne(Stok::class, 'kode_barang', 'kode_barang');
    }

    public function supplier (){
        return $this->hasOne(Supplier::class, "nama_supplier", "nama_supplier");
    }
}
