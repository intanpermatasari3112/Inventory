<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Stok;
class DashboardController extends Controller
{
    public function index()
    {
        $row = DB::table('users')
        ->select(DB::raw('name'))
        ->get();
        $countUser = count($row);

        $row = DB::table('barang')
        ->select(DB::raw('nama_barang'))
        ->get();
        $countBarang = count($row);

        $row = DB::table('barang_keluar')
        ->select(DB::raw('pengguna'))
        ->get();
        $countBarangKeluar= count($row);

        $row = DB::table('stok')
        ->select(DB::raw('stok'))->where(DB::raw('stok - batasMin'), '<=', '0')
        ->get();
        $countStok= count($row);
        $stok = new \App\Models\Stok;
        $data_stok = $stok->get();
            $data_barang_keluar = DB::table(DB::raw("(SELECT `barang_keluar`.*, jenis.jenis_barang as jenis, barang.nama_barang, users.email FROM `barang_keluar`
            INNER JOIN barang ON barang_keluar.kode_barang=barang.kode_barang
            INNER JOIN jenis ON barang.jenis_barang=jenis.id_jenis_barang
            INNER JOIN users ON barang_keluar.pengguna=users.email) x"));
            if(request()->status_pinjam)
            $data_barang_keluar=$data_barang_keluar->where('status_pinjam', request()->status_pinjam);
            if(Auth::user()->level=='PENGGUNA'){
                $data_barang_keluar->where('pengguna', Auth::user()->email);
            }
            $data_barang_keluar = $data_barang_keluar->orderBy('kode_barang_keluar', 'asc')->get();
        return view('dashboard.index', [
            'jumlahUser' => $countUser,
            'jumlahBarang' => $countBarang,
            'jumlahStok' => $countStok,
            'jumlahBarangKeluar' => $countBarangKeluar,
            'data_stok' => $data_stok,
            'data_barang_keluar' => $data_barang_keluar
        ]);
        
    }
}