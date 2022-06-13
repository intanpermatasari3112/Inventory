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

<<<<<<< HEAD
=======
    protected $casts = [
        'id_jenis' => 'json',
    ];


>>>>>>> e86f4b4c69ed67604fe6a0467d09328181eb1624
    public function jenis() {
        return $this->hasOne(Jenis::class, 'id_jenis_barang', 'id_jenis');
    }
}
