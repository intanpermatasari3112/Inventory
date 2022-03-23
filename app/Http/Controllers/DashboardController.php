<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        return view('dashboard.index', [
            'jumlahUser' => $countUser,
            'jumlahBarang' => $countBarang,
            'jumlahStok' => $countStok,
            'jumlahBarangKeluar' => $countBarangKeluar,
            'data_stok' => $data_stok
        ]);
    }
}