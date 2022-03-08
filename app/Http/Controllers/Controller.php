<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function getNextNomorUrut($idJenis){
        //ambil detail jenis dulu. untuk keperluan kodejenisnya
        $jenis = Jenis::where('id_jenis_barang', $idJenis)->first();

        //ambil kodeBarang terakhir berdasarkan jenis
        $lastKode = DB::select("SELECT max(kode_barang) as last_kode FROM barang WHERE jenis_barang = '$idJenis'");
        if(!empty($lastKode['last_kode'])){
            $getNomorurut = explode("-",$lastKode[0]->last_kode);
            $nomorUrut = $getNomorurut[2]; //last index
            $nextNmor = $nomorUrut+1;

            return $getNomorurut[0]. "-LTI-". str_pad($nextNmor, 4, "0", STR_PAD_LEFT); 
        }else{
            //ini dipake kalo emang belum ada data nya didatabase
            return 
            $jenis['kode_jenis']."-LTI-".str_pad("1", 4, "0", STR_PAD_LEFT);
        }
    }
}
