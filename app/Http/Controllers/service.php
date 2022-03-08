<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class service extends Controller
{
    public function index()
    {
        $data['data_barang'] = \App\Models\Barang::all();
        return response($data);
    }
    public function lihat()
    {
        $data['data_stok'] = \App\Models\Stok::all();
        return response($data);
    }
    public function lihatjenis()
    {
        $data['data_jenis'] = \App\Models\Jenis::all();
        return response($data);
    }
    public function detailBarang(Request $request)
    {
        $kodeBarang = $request->get('kode_barang');
        $data= \App\Models\Barang::where(['kode_barang' => $kodeBarang])->first();
        return response($data);
    }
}
