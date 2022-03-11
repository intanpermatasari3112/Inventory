<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Str;
use DB;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $data['data_barang'] = \App\Models\Barang::all();
        $data['jenis'] = Jenis::all();
        $data['kodesbarang'] = DB::table(DB::raw("(SELECT j.kode_jenis, max(substring_index(substring_index(b.kode_barang,'-',-1),',',1)) as lastid FROM jenis j join barang b on j.id_jenis_barang = b.jenis_barang group by j.kode_jenis) x"))->get();
        return view('barang.index',$data);
    }

    public function create(Request $request)
    {
        $file = $request->file("gambar");
        $insert = $request->all();
        $insert['gambar'] = $file->storeAs('berkas', Str::random(25) .'.'. $file->getClientOriginalExtension());
        \App\Models\Barang::create($insert);
        return redirect('/barang')->with('sukses','Data berhasil diinput');
    }
    public function edit($kode_barang)
    {
        $data['barang'] = \App\Models\Barang::find($kode_barang);
        $data['jenis'] = Jenis::all();
        return view('barang/edit', $data);
    }
    public function update(Request $request, $kode_barang)
    {
        $file = $request->file("gambar");
        $update = $request->all();
        if($file){
            $update['gambar'] = $file->storeAs('berkas', Str::random(25) .'.'. $file->getClientOriginalExtension());
        }
        $data = \App\Models\Barang::find($kode_barang);
        $berkaslama = $data->gambar;
        $data->update($update);
        if($berkaslama && $file){
            Storage::delete($berkaslama);
        }
        return redirect('/barang')->with('sukses', 'Data berhasil diupdate');
    }
    public function delete($kode_barang)
    {
        $data = \App\Models\Barang::find($kode_barang);
        $berkaslama = $data->gambar;
        $data->delete($data);
        if($berkaslama){
            Storage::delete($berkaslama);
        }
        return redirect('/barang')->with('sukses', 'Data berhasil dihapus');
    }
    public function cetak($kode_barang)
    {
        $data['barang'] = \App\Models\Barang::find($kode_barang);
        return view('barang.cetak',$data);
    }
}
