<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Laporan;
use App\Models\Barang;
use App\Models\Jenis;
use App\Models\Supplier;
use App\Models\User;

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
    public function laporansupplier()
    { 
        $last = \App\Models\Supplier::orderBy('id_supplier', 'desc')->first();
        $data['data_supplier'] = Supplier::all();
        $data['supplier'] = Supplier::all();
        $data['nextid'] = $last ? $last->id_supplier+1 : 1;
        return view('laporan.laporansupplier',$data);

    }
    public function laporanuser()
    { 
        $last = \App\Models\User::orderBy('id', 'desc')->first();
        $data['data_user'] = User::all();
        $data['user'] = User::all();
        $data['nextid'] = $last ? $last->id+1 : 1;
        return view('laporan.laporanuser',$data);
    }
    public function laporanstok()
    { 
        $last = \App\Models\Stok::orderBy('kodeStok', 'desc')->first();
        $data['data_stok'] = $stok->get();
        $data['barang'] = DB::table(DB::raw("(SELECT b.* FROM `barang` b LEFT JOIN `stok` s on s.kode_barang = b.kode_barang where s.kodeStok is null) x"))->get();
        $data['nextid'] = $last ? $last->kodeStok+1 : 1;
        return view('laporan.laporanstok',$data);

    }
}