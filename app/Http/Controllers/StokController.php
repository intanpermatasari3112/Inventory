<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Barang;
Use DB;

class StokController extends Controller
{
    public function index()
    {
        $stok = new \App\Models\Stok;

        if(request()->status_stok == 'habis')
            $stok = $stok->where(DB::raw('stok - batasMin'), '<=', '0');
        if(request()->status_stok == 'masih')
            $stok = $stok->where(DB::raw('stok - batasMin'), '>', '0');

        $last = \App\Models\Stok::orderBy('kodeStok', 'desc')->first();
        $data['data_stok'] = $stok->get();
        $data['barang'] = DB::table(DB::raw("(SELECT b.* FROM `barang` b LEFT JOIN `stok` s on s.kode_barang = b.kode_barang where s.kodeStok is null) x"))->get();
        $data['nextid'] = $last ? $last->kodeStok+1 : 1;
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
