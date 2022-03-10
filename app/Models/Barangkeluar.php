<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangkeluar extends Model
{
    protected $primaryKey = "kode_barang_keluar";
    protected $table = 'barang_keluar';
    protected $fillable = ['kode_barang_keluar', 'kode_barang',  'tanggal_keluar', 'jumlah', 'pengguna', 'keterangan'];
    public function barang() {
    return $this->hasOne(Barang::class, "kode_barang", "nama_barang", "jenis_barang");
}
}
