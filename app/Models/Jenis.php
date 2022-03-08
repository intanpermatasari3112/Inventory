<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $primaryKey = "id_jenis_barang";
    protected $table = 'jenis';
    protected $fillable = ['jenis_barang'];
}
