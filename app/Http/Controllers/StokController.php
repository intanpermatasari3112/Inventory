<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Barang;

class StokController extends Controller
{
    public function index()
    {
        $data['data_stok'] = \App\Models\Stok::all();
        $data['barang'] = Barang::all();
        return view('stok.index',$data);
    }
    public function create(Request $request)
    {
        \App\Models\Stok::create($request->all());
        return redirect('/stok')->with('sukses','Data berhasil diinput');
    }
    public function edit($kodeStok)
    {
        $data['stok'] = \App\Models\Stok::find($kodeStok);
        $data['barang'] = Barang::all();
        return view('stok/edit', $data);
    }
    public function update(Request $request, $kodeStok)
    {
        $data = \App\Models\Stok::find($kodeStok);
        $data->update($request->all());
        return redirect('/stok')->with('sukses', 'Data berhasil diupdate');
    }
    
    public function delete($kodeStok)
    {
        $data = \App\Models\Stok::find($kodeStok);
        $data->delete($data);
        return redirect('/stok')->with('sukses', 'Data berhasil dihapus');
    }
}
