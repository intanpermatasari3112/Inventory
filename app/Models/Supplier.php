<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $primaryKey = "id_supplier";
    protected $table = 'supplier';
    protected $fillable = ['nama_supplier','kontak'];
}
