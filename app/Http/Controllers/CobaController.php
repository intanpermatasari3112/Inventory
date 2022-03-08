<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CobaController extends Controller
{
    public function index()
    {
        //last kodeBarang 
        //ini untuk kasus elektronik
        //kasus yang lain juga sama
        //sebelum insert, dia harus select dulu berdasarkan kategori nya baru di insert datanya
    // paham? 
    //cobain
    //upload github caranya gimana mas:'V
    //install git dulu
    //baru upload
        $lastKode = DB::select("SELECT max(kode_barang) as last_kode FROM barang WHERE jenis_barang = '2'");
        return print_r($lastKode);
        if(!empty($lastKode)){
            $getNomorurut = explode("-",$lastKode[0]->last_kode);
            $nomorUrut = $getNomorurut[2]; //last index
            $nextNmor = $nomorUrut+1;

            return "EL-LTI-". str_pad($nextNmor, 4, "0", STR_PAD_LEFT); 
        }else{
            //ini dipake kalo emang belum ada data nya didatabase
            return 
            "EL-LTI-".str_pad("1", 4, "0");
        }
    }
}
