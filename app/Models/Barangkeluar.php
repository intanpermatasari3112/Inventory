<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangkeluar extends Model
{
    protected $primaryKey = "kode_barang_keluar";
    protected $table = 'barang_keluar';
    protected $fillable = ['kode_barang_keluar', 'kode_barang', 'jenis_barang', 'tanggal_keluar', 'jumlah', 'pengguna', 'keterangan'];
    public function barang() {
    return $this->hasOne(Barang::class, "kode_barang", "nama_barang");
}
public function user() {
    return $this->hasMany(User::class, 'id', 'name');
}
public function jenis() {
    return $this->hasOne(Jenis::class, 'id_jenis_barang', 'jenis_barang');
}
}
