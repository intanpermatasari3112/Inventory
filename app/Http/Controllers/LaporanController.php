<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Laporan;
use App\Models\Barang;
use App\Models\Barangkeluar;
use App\Models\Jenis;
use App\Models\Supplier;
use App\Models\User;
use DB;
use Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $data_barang_keluar = new \App\Models\Barangkeluar();
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
        $data['data_barang_keluar'] = $data_barang_keluar->orderBy('kode_barang_keluar', 'asc')->get();
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
        $stok = new \App\Models\Stok;
        $data['data_stok'] =$stok->where(DB::raw('stok - batasMin'), '<=', '0')->get();
        $last = \App\Models\Stok::orderBy('kodeStok', 'desc')->first();
        $data['barang'] = DB::table(DB::raw("(SELECT b.* FROM `barang` b LEFT JOIN `stok` s on s.kode_barang = b.kode_barang where s.kodeStok is null) x"))->get();
        $data['nextid'] = $last ? $last->kodeStok+1 : 1;
        return view('laporan.laporanstok',$data);

    }
    public function laporanbarangdipinjam()
    {
        $data_barang_keluar = DB::table(DB::raw("(SELECT `barang_keluar`.*, jenis.jenis_barang as jenis, barang.nama_barang, users.email FROM `barang_keluar`
        INNER JOIN barang ON barang_keluar.kode_barang=barang.kode_barang
        INNER JOIN jenis ON barang.jenis_barang=jenis.id_jenis_barang
        INNER JOIN users ON barang_keluar.pengguna=users.email) x"));
        $last = \App\Models\Barangkeluar::orderBy('kode_barang_keluar', 'desc')->first();
        $data['data_barang_keluar'] = $data_barang_keluar->orderBy('kode_barang_keluar', 'asc')->get();
        $data['jenis'] = Jenis::all();
        $data['kodesbarang'] = DB::table(DB::raw("(SELECT j.kode_jenis, max(substring_index(substring_index(b.kode_barang,'-',-1),',',1)) as lastid FROM jenis j left join barang b on j.id_jenis_barang = b.jenis_barang group by j.kode_jenis) x"))->get();
        $data['user'] = User::all();
        $data['barang'] = Barang::all();
        $data['nextid'] = $last ? $last->kode_barang_keluar + 1 : 1;
        return view('laporan.laporanbarangdipinjam', $data);
    }


    public function index_cetak()
    {
        $barang = new \App\Models\Barang();
        if(request()->dari_tgl)
            $barang = $barang->where('tanggal_masuk', '>=', request()->dari_tgl);
        if(request()->sampai_tgl)
            $barang = $barang->where('tanggal_masuk', '<=', request()->sampai_tgl);
        if(request()->jenis)
            $barang = $barang->where('jenis_barang', request()->jenis);
        $data['data_barang'] = $barang->get();
        return view('laporan.cetak.index', $data);
    }

    public function laporansupplier_cetak()
    {
        $data['data_supplier'] = Supplier::all();
        $data['supplier'] = Supplier::all();
        return view('laporan.cetak.laporansupplier',$data);
    }

    public function laporanuser_cetak()
    {
        $data['data_user'] = User::all();
        return view('laporan.cetak.laporanuser',$data);
    }

    public function laporanstok_cetak()
    {

    }

    public function laporanbarangdipinjam_cetak()
    {
        $data_barang_keluar = DB::table(DB::raw("(SELECT `barang_keluar`.*, jenis.jenis_barang as jenis, barang.nama_barang, users.email FROM `barang_keluar`
        INNER JOIN barang ON barang_keluar.kode_barang=barang.kode_barang
        INNER JOIN jenis ON barang.jenis_barang=jenis.id_jenis_barang
        INNER JOIN users ON barang_keluar.pengguna=users.email) x"));
        $data['data_barang_keluar'] = $data_barang_keluar->orderBy('kode_barang_keluar', 'asc')->get();
        return view('laporan.cetak.laporanbarangdipinjam', $data);
    }
}