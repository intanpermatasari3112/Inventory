<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Laporan;
use App\Models\Barang;
use App\Models\Jenis;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $barang = new \App\Models\Barang();
        if(request()->dari_tgl)
            $barang = $barang->where('tanggal_masuk', '>=', request()->dari_tgl);
        if(request()->sampai_tgl)
            $barang = $barang->where('tanggal_masuk', '<=', request()->sampai_tgl);
        if(request()->jenis)
            $barang = $barang->where('jenis_barang', request()->jenis);
        $data['data_barang'] = $barang->get();
        $data['stok'] = Stok::all();
        $data['jenis'] = Jenis::all();
        return view('laporan.index',$data);
    }
}