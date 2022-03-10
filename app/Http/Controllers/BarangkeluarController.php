<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use App\Models\Barang;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\Storage;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $data['data_barang_keluar'] = \App\Models\Barangkeluar::all();
        $data['jenis'] = Jenis::all();
        $data['barang'] = Barang::all();
        return view('barangkeluar.index',$data);
    }
}
