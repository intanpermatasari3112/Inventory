<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $primaryKey = "kodeStok";
    protected $table = 'stok';
    protected $fillable = ['kodeStok', 'kode_barang', 'batasMin', 'stok'];

    public function barang() {
        return $this->hasOne(Barang::class, 'kode_barang', 'kode_barang');
    }
}
