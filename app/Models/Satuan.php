<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = 'satuan';
    protected $fillable = ['urai', 'id_jenis'];

    public function jenis() {
        return $this->hasOne(Jenis::class, 'id_jenis_barang', 'id_jenis');
    }
}
